const url = new URL(
    "https://dev.dreamjo.bs/api/items"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "'Buy groceries'"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());

const app = new Vue({
    el: "#app",
    data: {
//      addFriend: null,
      editFriend: null,
      friends: [],
    },
    methods: {
      deleteFriend(id, i) {
        fetch("https://dev.dreamjo.bs/api/items/" + id, {
          method: "DELETE"
        })
        .then(() => {
          this.friends.splice(i, 1);
        })
      },
      addFriend(friend) {
        fetch("https://dev.dreamjo.bs/api/items/" + friend.id, {
          body: JSON.stringify(friend),
          method: "POST",
          headers: {
	    "Content-Type": "application/json",
	    "Accept": "application/json",
          },
        })
        .then(() => {
          this.addFriend = null;
        })
      },
      updateFriend(friend) {
        fetch("https://dev.dreamjo.bs/api/items/" + friend.id, {
          body: JSON.stringify(friend),
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then(() => {
          this.editFriend = null;
        })
      }
    },
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
        <div>
          <input v-on:keyup.13="addFriend" v-model="friend.name" />
          <button v-on:click="addFriend">save</button>
        </div>
        <div v-if="editFriend === friend.id">
          <input v-on:keyup.13="updateFriend(friend)" v-model="friend.name" />
          <button v-on:click="updateFriend(friend)">save</button>
        </div>
        <div v-else>
          <button>add</button>
          <button v-on:click="editFriend = friend.id">edit</button>
          <button v-on:click="deleteFriend(friend.id, i)">x</button>
          {{friend.name}}
        </div>
      </li>
    </div>
    `,
});