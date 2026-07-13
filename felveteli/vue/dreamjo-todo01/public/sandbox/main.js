const app = new Vue({
    el: "#app",
    data: {
      newFriend: null,
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
        fetch("https://dev.dreamjo.bs/api/items", {
          body: JSON.stringify(friend),
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then(() => {
          this.newFriend = null;
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
        <div v-if="newFriend === friend.id">
          <input v-on:keyup.13="addFriend(friend)" v-model="friend.name" />
          <button v-on:click="addFriend(friend)">save</button>
        </div>
        <div v-if="editFriend === friend.id">
          <input v-on:keyup.13="updateFriend(friend)" v-model="friend.name" />
          <button v-on:click="updateFriend(friend)">save</button>
        </div>
        <div v-else>
          <button v-on:click="newFriend = friend.id">new</button>
          <button v-on:click="editFriend = friend.id">edit</button>
          <button v-on:click="deleteFriend(friend.id, i)">x</button>
          {{friend.name}}
        </div>
      </li>
    </div>
    `,
});