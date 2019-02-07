<template>
    <div class="row">
        <div class="alert alert-success" v-if="saved">
            <strong>Success!</strong> Your entry was saved.
        </div>

        <div class="well well-sm" id="add-entry-form">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <fieldset>
                    <legend class="text-center">Add real estate entry</legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Title</label>
                        <div class="col-md-9" :class="{'has-error': errors.name}">
                            <input id="name"
                                   v-model="entry.name"
                                   type="text"
                                   placeholder="Title"
                                   class="form-control">
                            <span v-if="errors.name" class="help-block text-danger">{{ errors.name[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="city_id">City</label>
                        <div class="col-md-9 text-left" :class="{'has-error': errors.city_id}">
							<select v-model="entry.city_id" id="city_id">
								<option disabled value="">Please select one</option>
								<option v-for="city in cities" v-bind:value="city.id">
								{{ city.name }}
								</option>
							</select>
                            <span v-if="errors.city_id" class="help-block text-danger">{{ errors.city_id[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="developer_id">Developer</label>
                        <div class="col-md-9 text-left" :class="{'has-error': errors.developer_id}">
							<select v-model="entry.developer_id" id="developer_id" >
								<option disabled value="">Please select one</option>
								<option v-for="developer in developers" v-bind:value="developer.id">
								{{ developer.name }}
							  </option>
							</select>
                            <span v-if="errors.developer_id" class="help-block text-danger">{{ errors.developer_id[0] }}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">Price</label>
                        <div class="col-md-9" :class="{'has-error': errors.price}">
                            <input id="price"
                                   v-model="entry.price"
                                   type="text"
                                   placeholder="Price"
                                   class="form-control">
                            <span v-if="errors.price" class="help-block text-danger">{{ errors.price[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="is_on_sale">Is On Sale</label>
                        <div class="col-md-9 text-left" :class="{'has-error': errors.is_on_sale}">
							<select v-model="entry.is_on_sale" id="is_on_sale">
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
                            <span v-if="errors.is_on_sale" class="help-block text-danger">{{ errors.is_on_sale[0] }}</span>
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
    </div>
</template>

<script>
import { globalEventBus } from '../app';
    export default {

        data() {
            return {
                errors: [],
                saved: false,
				cities:[],
				developers:[],
                entry: {
                    title: null,
                    country_id: null,
					developer_id: null,
                    price: null,
					is_on_sale: null,

                }
            };
        },
		mounted: function () {
			var self = this;
			axios.get('api/cities')
				.then(({data}) => {
					self.cities = data;
//					console.log('AddEntryForm.vue self.cities:');
//					console.log(self.cities);
				});

			axios.get('api/developers')
				.then(({data}) => {
					self.developers = data;
//					console.log('AddEntryForm.vue self.developers:');
//					console.log(self.developers);
				});
		},
        methods: {
            onSubmit() {
                this.saved = false;
                axios.post('api/lists', this.entry)
                    .then(({data}) => this.setSuccessMessage())
                    .catch(({response}) => this.setErrors(response));
            },

            setErrors(response) {
                this.errors = response.data;
//				console.log('AddEntryForm.vue this.errors:');
//				console.log(this.errors);
            },

            setSuccessMessage() {
                this.reset();
                this.saved = true;
				globalEventBus.$emit('entryAdded', true);
//				console.log('emitting: entryAdded');

            },

            reset() {
                this.errors = [];
                this.entry = {
                    title: null,
                    country_id: null,
					developer_id: null,
                    price: null,
					is_on_sale: null
                };
            }
        }
    }
</script>
