<template>
	<div class="row">
		<div class="well well-sm">
			<form class="form-horizontal" @submit.prevent="submitSearch(false)">
				<fieldset>
					<legend class="text-center">Search real estate entry</legend>
					<div class="form-group">
						<label class="col-md-3 control-label" for="search_country_id">Country</label>
						<div class="col-md-9 text-left">
							<select id="search_country_id">
								<option disabled value="">Please select one</option>
								<option value="all" selected="selected">all</option>
								<option v-for="country in availableCountries" v-bind:value="country">
								{{ country }}
								</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="search_price">Price</label>
						<div class="col-md-9 text-lef">
							<input id="search_price" type="text" placeholder="Price" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="search_is_on_sale">Is on sale</label>
						<div class="col-md-9 text-left">
							<select id="search_is_on_sale" >
								<option value="all" selected="selected">All</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>

				</fieldset>
			</form>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Title</th>
					<th scope="col">Country</th>
					<th scope="col">Price</th>
					<th scope="col">OnSale</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="entry in entries" @click="entrySelected(entry.id)">
					<th scope="row">{{ entry.id }}</th>
					<td>{{ entry.name }}</td>
					<td>{{ entry.country }}</td>
					<td>{{ entry.price }}</td>
					<td>{{ entry.is_on_sale }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
import { globalEventBus } from '../app';

    export default {

        data() {
            return {
                entries: [],
				entryFormData: {},
				availableCountries:[]

            };
        },

        created() {
            this.submitSearch(true);
			this.getAvailableCountries();
			globalEventBus.$on('entryAdded', () => {
				this.submitSearch(false);
//				console.log('received entryAdded:'+entry_id);
			});

        },

        methods: {
            getAvailableCountries() {
                axios.get('api/countries').then(({data}) => {
					this.availableCountries = data;
//					console.log('Entries.vue this.availableCountries:');
//					console.log(this.availableCountries);
				});
            },

            submitSearch(initialCall) {
				var getParams={}
				if(initialCall==false){
					var isOnSale = $( "#search_is_on_sale" ).val();
					if(isOnSale!='all'){
						getParams['is_on_sale']=isOnSale;
					}
					var country = $( "#search_country_id" ).val();
					if (country!='all') {
						getParams['country']=country;
					}
					var price = $( "#search_price" ).val();
;					if (price.length>0) {
						getParams['price']=price;
					}
				}
//					console.log('Entries.vue makeSearchRequest getParams:');
//					console.log(getParams);

                axios.get('api/lists',{'params': getParams}).then(({data}) => {
					this.entries = data;
//					console.log('Entries.vue makeSearchRequest this.entries:');
//					console.log(this.entries);
                });
            },
			
		entrySelected: function (entry_id) {
			globalEventBus.$emit('entrySelected', entry_id);
//			console.log('emitting entrySelected: '+entry_id);
		}

        }
    }
</script>
