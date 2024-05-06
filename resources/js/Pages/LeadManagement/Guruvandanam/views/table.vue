<template>
    <div>
      <table class="min-w-full text-left text-sm font-light">
          <thead class = "border-b font-medium dark:border-neutral-500">
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>School</th>
                  <th>Locality</th>         
                 
              </tr>
          </thead>
          <tbody>
 
              <tr v-for="(data, index) in results" v-if="results && results.length" :key="index">
                  <td>{{ data.name }}</td>
                  <td>{{ data.email }}</td>
                  <td>{{ data.phone }}</td>
                  <td>{{ data.school }}</td>
                  <td >{{ data.locality }}</td>          
              </tr>
              <tr v-else>
                  <td colspan="14">
                      <div class="text-center">No Data Available</div>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>


</template>

<script>
export default {
    props:{
			results: {
		  		type: Array,
		  		required: true,
			},
			meta: {
				type: Object,
				required: true,
			}
	  	},
  data() {
      return {
  
      }
  },
methods: {

},
mounted() {
    
  }


};
</script>


