<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ initialChannel.name }}</div>
        <div class="panel-body">
            <form>
                <input class="form-control" type="text" v-model="initialChannel.id">
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-12 text-left border-bottom">Source team ({{ initialChannel.source_language }} - {{ initialChannel.target_language1 }})</label>
                    <div class="col-sm-12">
                        <select class="user-select" v-model="users1" multiple>
                            <option v-for="user in initialUsers" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-12 text-left border-bottom">Target team ({{ initialChannel.target_language1 }} - {{ initialChannel.target_language2 }})</label>
                    <div class="col-sm-12">
                        <select class="user-select" v-model="users2" multiple>
                            <option v-for="user in initialUsers" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer text-center">
            <button type="submit" @click.prevent="createGroup" class="btn btn-primary">Create Group</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['initialUsers', 'initialChannel'],

        data() {
            return {
                name: '',
                users1: [],
                users2: [],
                channel: ''
            }
        },

        methods: {
            createGroup() {
                axios.post('/groups', {users1: this.users1, users: this.users2, channel: this.initialChannel.id})
                .then((response) => {
                    this.name = '';
                    this.users = [];
                    Bus.$emit('groupCreated', response.data);
                });
            }
        }
    }
</script>
