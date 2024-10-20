<template>
    <div>
      <h1>Gerenciar Jogos</h1>
      <ul>
        <li v-for="player in players" :key="player.id">{{ player.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        players: [],
      };
    },
    mounted() {
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
  };
  </script>
  