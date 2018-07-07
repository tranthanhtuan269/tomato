<template>
    <div class="modal fade" id="create-channel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Channel</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input class="form-control" type="text" v-model="name" placeholder="Channel Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-12 text-left border-bottom">Source team</label>
                            <div class="col-sm-6">
                                <select v-model="source_language" class="form-control">
                                    <option v-for="language in initialLanguages" :value="language.name">
                                        {{ language.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select v-model="target_language" class="form-control">
                                    <option v-for="language in initialLanguages" :value="language.name">
                                        {{ language.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-12 text-left border-bottom">Target team</label>
                            <div class="col-sm-6">
                                <select v-model="target_language" class="form-control">
                                    <option v-for="language in initialLanguages" :value="language.name">
                                        {{ language.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select v-model="target_language2" class="form-control">
                                    <option v-for="language in initialLanguages" :value="language.name">
                                        {{ language.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" @click.prevent="createChannel" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    export default {
        props: ['initialLanguages'],

        data() {
            return {
                name                : '',
                source_language     : '',
                target_language     : '',
                source_language2    : '',
                target_language2    : '',
            }
        },

        methods: {
            createChannel() {
                axios.post('/channels/store', {
                                        name                : this.name, 
                                        source_language     : this.source_language,
                                        target_language     : this.target_language,
                                        source_language2    : this.source_language2,
                                        target_language2    : this.target_language2
                                        })
                .then((response) => {
                    var url = $('base').attr('href');
                    window.location.replace(url + '/channels/' + response.data.id);
                });
            }
        }
    }
</script>
