<template>
  <div>
    <h1>Manage Players</h1>
    <ul>
      <li v-for="player in players" :key="player.id">
        {{ player.name }} - {{ player.position }}
        <button @click="deletePlayer(player.id)">Delete</button>
      </li>
    </ul>

    <form @submit.prevent="addPlayer">
      <input v-model="newPlayer.name" placeholder="Name">
      <input v-model="newPlayer.position" placeholder="Position">
      <button type="submit">Add Player</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      players: [],
      newPlayer: {
        name: '',
        position: ''
      }
    };
  },
  mounted() {
    this.fetchPlayers();
  },
  methods: {
    fetchPlayers() {
      fetch('/api/players', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
      })
      .then(response => response.json())
      .then(data => {
        this.players = data;
      });
    },
    addPlayer() {
      fetch('/api/players', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
        body: JSON.stringify(this.newPlayer)
      })
      .then(() => {
        this.newPlayer.name = '';
        this.newPlayer.position = '';
        this.fetchPlayers(); // Recarregar a lista de players
      });
    },
    deletePlayer(id) {
      fetch(`/api/players/${id}`, {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        }
      })
      .then(() => {
        this.fetchPlayers();
      });
    }
  }
}
</script>
