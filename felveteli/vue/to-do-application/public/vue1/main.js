const url = new URL(
    "https://dev.dreamjo.bs/api/items"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());

    mounted() {
      fetch("https://dev.dreamjo.bs/api/items")
        .then(response => response.json())
        .then((data) => {
          this.friends = data;
        })
    },
    template: `
    <div>
      <li v-for="friend, i in friends">
        <div v-if="editFriend === friend.id">
          <input v-on:keyup.13="updateFriend(friend)" v-model="friend.name" />
          <button v-on:click="updateFriend(friend)">save</button>
        </div>
        <div v-if="addFriend === friend.id">
          <input v-on:keyup.13="addFriend(friend)" v-model="friend.name" />
          <button v-on:click="addFriend(friend)">save</button>
        </div>
        <div v-else>
          <button v-on:click="addFriend = friend.id">add</button>
          <button v-on:click="editFriend = friend.id">edit</button>
          <button v-on:click="deleteFriend(friend.id, i)">x</button>
          {{friend.name}}
        </div>
      </li>
    </div>
    `,
});