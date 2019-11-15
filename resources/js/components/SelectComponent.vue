<template>
    <treeselect v-model="value" :multiple="true" :options="options" :name="this.name" :values="this.values"/>
</template>

<script>

  // import the component
  import Treeselect from '@riophae/vue-treeselect'
  // import the styles
  import '@riophae/vue-treeselect/dist/vue-treeselect.css'

  export default {
    components: { Treeselect },
    props: ['name', 'values'],
    data() {
      return {
        // define the default value
        value: [],
        // define options
        options: [ 
        ],
      }
    },
    created: function(){
      if (this.values) {
        for (let element of JSON.parse(this.values)) {
            this.value.push(element);
        }; 
      }
    },
    mounted() {
            this.fetchTags();
        },
        methods: {
            fetchTags: function() {
                axios
                    .get("/api/tags")
                    .then(response => {
                        for (const [key, value] of Object.entries(response.data)) {
                            let item = {}
                            item.id = key;
                            item.label = value;
                            this.options.push(item);
                        }
                    })
                    .catch(error => {
                        this.errors.push(error);
                    });
            },
        }
  }
</script>
