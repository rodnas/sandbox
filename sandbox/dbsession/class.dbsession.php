<?php
error_reporting(E_ALL);

class dbSession
	{
	function dbSession($gc_maxlifetime = "", $gc_probability = "", $gc_divisor = "", $securityCode = "sEcUr1tY_c0dE")
		{
		if ($gc_maxlifetime != "" && is_integer($gc_maxlifetime))
			{
			@ini_set('session.gc_maxlifetime', $gc_maxlifetime);
			}
		if ($gc_probability != "" && is_integer($gc_probability))
			{
			@ini_set('session.gc_probability', $gc_probability);
			}
		if ($gc_divisor != "" && is_integer($gc_divisor))
			{
			@ini_set('session.gc_divisor', $gc_divisor);
			}
		$this->sessionLifetime = ini_get("session.gc_maxlifetime");
		$this->securityCode = $securityCode;
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);
		register_shutdown_function('session_write_close');
		session_start();
		}

	function stop()
		{
		$this->regenerate_id();
		session_unset();
		session_destroy();
		}

	function regenerate_id()
		{
		$oldSessionID = session_id();
		session_regenerate_id();
		$this->destroy($oldSessionID);
		}

	function get_users_online()
		{
		$this->gc($this->sessionLifetime);
		$result = @mysql_fetch_assoc(@mysql_query("
		SELECT
		COUNT(session_id) as count
		FROM session_data
		"));
	        return $result["count"];
		}

	function open($save_path, $session_name)
		{
		return true;
		}

	function close()
		{
		return true;
		}

	function read($session_id)
		{
		$result = @mysql_query("
		SELECT
		session_data
		FROM
		session_data
		WHERE
		session_id = '".mysql_real_escape_string($session_id)."' AND
		http_user_agent = '".mysql_real_escape_string(md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode))."' AND
		session_expire > '".time()."'
		LIMIT 1
		");

		if (is_resource($result) && @mysql_num_rows($result) > 0)
			{
			$fields = @mysql_fetch_assoc($result);
			return $fields["session_data"];
			}
		return "";
		}

	function write($session_id, $session_data)
		{
		$result = @mysql_query("
		INSERT INTO
		session_data (
		session_id,
		http_user_agent,
		session_data,
		session_expire
		)
		VALUES (
		'".mysql_real_escape_string($session_id)."',
		'".mysql_real_escape_string(md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode))."',
		'".mysql_real_escape_string($session_data)."',
		'".mysql_real_escape_string(time() + $this->sessionLifetime)."'
		)
		ON DUPLICATE KEY UPDATE
		session_data = '".mysql_real_escape_string($session_data)."',
		session_expire = '".mysql_real_escape_string(time() + $this->sessionLifetime)."'
		");
		if ($result)
			{
			if (@mysql_affected_rows() > 1)
				{
				return true;
				}
			else
				{
				return "";
				}
			}
		return false;
		}

	function destroy($session_id)
		{
		$result = @mysql_query("
		DELETE FROM
		session_data
		WHERE
		session_id = '".mysql_real_escape_string($session_id)."'
		");
		if (@mysql_affected_rows())
			{
			return true;
			}
		return false;
		}

	function gc($maxlifetime)
		{
		$result = @mysql_query("
		DELETE FROM
		session_data
		WHERE
		session_expire < '".mysql_real_escape_string(time() - $maxlifetime)."'
		");
		}
	}
?>
