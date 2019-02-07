<template>
<div class="modal" tabindex="-1" role="dialog" id="showEntryModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		
      <div class="modal-body">
		<div class="container-fluid text-left">
			<div class="row">
				<div class="col-md-4"><strong>Title:</strong></div>
				<div class="col-md-8">{{ list_data.name }}</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Developer:</strong></div>
				<div class="col-md-8">{{ list_data.developer }}</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Country:</strong></div>
				<div class="col-md-8">{{ list_data.country }}</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>City:</strong></div>
				<div class="col-md-8">{{ list_data.city }}</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Price:</strong></div>
				<div class="col-md-8">{{ list_data.price }}</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Is on sale:</strong></div>
				<div class="col-md-8">{{ list_data.is_on_sale }}</div>
			</div>
		</div>

      </div>
    </div>
  </div>
</div>
</template>
<script>
	import { globalEventBus } from '../app';
    export default {
			
        data() {
            return {
                list_data: {},
				list_id:null
            };
        },

        created() {
            
 
			// Using the server bus
			globalEventBus.$on('entrySelected', (entry_id) => {
				this.list_id=entry_id;
				this.fetch();
//				console.log('received:'+entry_id);
				$('#showEntryModal').modal()
			});
			
        },

        methods: {
            fetch() {
                axios.get('api/lists/'+this.list_id)
                    .then(({data}) => {
                        this.list_data = data;
//				console.log('list_data');
//				console.log(this.list_data);
                    });
            },

        }
    }
</script>
