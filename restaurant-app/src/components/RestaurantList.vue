<template>
  <div class="container">
    <h1>Restaurant Listing</h1>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="input-group mb-3">
          <input type="text" class="form-control" v-model="searchQuery" @input="filterRestaurants" placeholder="Search by name or cuisine">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 ">
        <div class="card-deck">
          <div v-for="restaurant in filteredRestaurants" :key="restaurant.id" class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ restaurant.name }}</h5>
              <p class="card-text">Cuisine: {{ restaurant.cuisine }}</p>
              <p class="card-text">Rating: {{ restaurant.rating }}</p>
            </div>
          </div>
        </div>
        <div v-if="filteredRestaurants.length === 0" class="alert alert-warning" role="alert">
          No restaurants found.
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      restaurants: [],
      searchQuery: ''
    };
  },
  computed: {
    filteredRestaurants() {
      return this.restaurants.filter(restaurant =>
        restaurant.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        restaurant.cuisine.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  mounted() {
    this.fetchRestaurants();
  },
  methods: {
    async fetchRestaurants() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/restaurants');
        this.restaurants = response.data;
      } catch (error) {
        console.error('Error fetching restaurants:', error);
      }
    },
    filterRestaurants() {
      // You can add debounce logic here to limit API calls
      this.fetchRestaurants();
    }
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
}

.search {
  margin-bottom: 20px;
}

.restaurant {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
}
</style>
