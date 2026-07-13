
<?php

/****************************************************************
                Email address validation script
  v2.1.2 Written by Mark 'Tarquin' Wilton-Jones - 26-28/01/2004
 Updated 12/02/2004 to allow all valid email address formats and
 improve RFC compliance, and use MX record weightings
 Updated 09/05/2004 to allow Norwegian characters
 Updated 07/07/2009 to avoid a warning
******************************************************************

Please see http://www.howtocreate.co.uk/jslibs/termsOfUse.html for terms and
conditions of use.

Requires PHP 4.0 (min) with support for Perl compatible regular expression functions.
Windows (NT/2000/XP) installations will need to provide the getmxrr function - see:
http://uk.php.net/manual/en/function.getmxrr.php

This is superior to regular pattern matching email address validators, because it
actually attempts to contact the relevant mail exchange servers to prove that the
email address actually exists. Note that some mail exchangers will accept all
usernames, even if the username does not exist as a valid email user.

This script accepts all valid email address formats, including:
"any @ characters\\\" < that> you !%$& want"@mailDomain.com

It will check each available server until one permits a connection. It then attempts
to initialise an email to the specified email address.

If the server accepts the email, it is cancelled, and the email address is assumed
to be valid. If the server rejects the email, the email address is assumed to be
invalid.

WARNING: the check will show the email address as invalid if all available MX servers
are offline or are busy, even though the email address may be valid.

I plan to add functionality to show temporary failures like these in version 3
(I have not yet planned when to write or release version 3).

This library provides one function:

    mixed checkEmail( string email_address[, optional boolean debug] )

The function can operate in two modes;
    1) email validating:
        boolean valid_email = checkEmail( $email_address );
    2) email validation debugging:
        Array( boolean valid_email, Array debugging_messages ) = checkEmail( $email_address, true );

A typical use of the validating mode is to use:

    if( checkEmail( $email_address ) ) {
        // use mail() to send the email
        ...
    } else {
        print 'Your email address is not valid';
    }

A typical use of the debugging mode is to use:

    $return_msgs = checkEmail( $email_address, true );
    foreach( $return_msgs[1] as $debug_msg ) { print htmlspecialchars( $debug_msg ).'<br />'; }
    print $return_msgs[0] ? 'Email address seems to be valid' : 'Email address does not seem to be valid';
____________________________________________________________________________________________________________*/

function checkEmail( $email, $chFail = false ) {
    $msgs = Array(); $msgs[] = 'Received email address: '.$email;
    //check for email pattern (adapted and improved from http://karmak.org/archive/2003/02/validemail.html)
    //incorrectly allows IP addresses with block numbers > 256, but those will fail to create sockets anyway
    //unicode norwegian chars cannot be used: C caron, D stroke, ENG, N acute, S caron, T stroke, Z caron (PHP unicode limitation)
    if( !preg_match( "/^(([^<>()[\]\\\\.,;:\s@\"]+(\.[^<>()[\]\\\\.,;:\s@\"]+)*)|(\"([^\"\\\\\r]|(\\\\[\w\W]))*\"))@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([a-z\-0-9†ÖÑáÇäà§¢ïìîÅëoÜ]+\.)+[a-z]{2,}))$/i", $email ) ) {
        $msgs[] = 'Email address was not recognised as a valid email pattern';
        return $chFail ? Array( false, $msgs ) : false; }
    $msgs[] = 'Email address was recognised as a valid email pattern';
    //get the mx host name
    if( preg_match( "/@\[[\d.]*\]$/", $email ) ) {
        $mxHost[0] = preg_replace( "/[\w\W]*@\[([\d.]+)\]$/", "$1", $email );
        $msgs[] = 'Email address contained IP address '.$mxHost[0].' - no need for MX lookup';
    } else {
        //get all mx servers - if no MX records, assume domain is MX (SMTP RFC)
        $domain = preg_replace( "/^[\w\W]*@([^@]*)$/i", "$1", $email );
        if( !getmxrr( $domain, $mxHost, $weightings ) ) { $mxHost[0] = $domain;
            $msgs[] = 'Failed to obtain MX records, defaulting to '.$domain.' as specified by SMTP protocol';
        } else { array_multisort( $weightings, $mxHost );
            $cnt = ''; $co = 0; foreach( $mxHost as $ch ) { $cnt .= ( $cnt ? ', ' : '' ) . $ch . ' (' . $weightings[$co] . ')'; $co++; }
            $msgs[] = 'Obtained the following MX records for '.$domain.': '.$cnt; }
    }
    //check each server until you are given permission to connect, then check only that one server
    foreach( $mxHost as $currentHost ) {
        $msgs[] = 'Checking MX server: '.$currentHost;
        if( $connection = @fsockopen( $currentHost, 25 ) ) {
            $msgs[] = 'Created socket ('.$connection.') to '.$currentHost;
            if( preg_match( "/^2\d\d/", $cn = fgets( $connection, 1024 ) ) ) {
                $msgs[] = $currentHost.' sent SMTP connection header - no futher MX servers will be checked: '.$cn;
                while( preg_match( "/^2\d\d-/", $cn ) ) { $cn = fgets( $connection, 1024 );
                    $msgs[] = $currentHost.' sent extra connection header: '.$cn; } //throw away any extra rubbish
                if( !$_SERVER ) { global $HTTP_SERVER_VARS; $_SERVER = $HTTP_SERVER_VARS; }
                //attempt to send an email from the user to themselves (not <> as some misconfigured servers reject it)
                $localHostIP = gethostbyname(preg_replace("/^.*@|:.*$/",'',$_SERVER['HTTP_HOST']));
                $localHostName = gethostbyaddr($localHostIP);
                fputs( $connection, 'HELO '.($localHostName?$localHostName:('['.$localHostIP.']'))."\r\n" );
                if( $success = preg_match( "/^2\d\d/", $hl = fgets( $connection, 1024 ) ) ) {
                    $msgs[] = $currentHost.' sent HELO response: '.$hl;
                    fputs( $connection, "MAIL FROM: <$email>\r\n" );
                    if( $success = preg_match( "/^2\d\d/", $from = fgets( $connection, 1024 ) ) ) {
                        $msgs[] = $currentHost.' sent MAIL FROM response: '.$from;
                        fputs( $connection, "RCPT TO: <$email>\r\n" );
                        if( $success = preg_match( "/^2\d\d/", $to = fgets( $connection, 1024 ) ) ) {
                            $msgs[] = $currentHost.' sent RCPT TO response: '.$to;
                        } else { $msgs[] = $currentHost.' rejected recipient: '.$to; }
                    } else { $msgs[] = $currentHost.' rejected MAIL FROM: '.$from; }
                } else { $msgs[] = $currentHost.' rejected HELO: '.$hl; }
                fputs( $connection, "QUIT\r\n");
                fgets( $connection, 1024 ); fclose( $connection );
                //see if the transaction was permitted (i.e. does that email address exist)
                $msgs[] = $success ? ('Email address was accepted by '.$currentHost) : ('Email address was rejected by '.$currentHost);
                return $chFail ? Array( $success, $msgs ) : $success;
            } elseif( preg_match( "/^550/", $cn ) ) {
                $msgs[] = 'Mail domain denies connections from this host - no futher MX servers will be checked: '.$cn;
                return $chFail ? Array( false, $msgs ) : false;
            } else { $msgs[] = $currentHost.' did not send SMTP connection header: '.$cn; }
        } else { $msgs[] = 'Failed to create socket to '.$currentHost; }
    } $msgs[] = 'Could not establish SMTP session with any MX servers';
    return $chFail ? Array( false, $msgs ) : false;
}

?>

