<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ channel.name }}</div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-12 text-left border-bottom">Source team ({{ channel.source_language }} - {{ channel.target_language1 }})</label>
                    <div class="col-sm-12">
                        <select v-model="users1" multiple>
                            <option v-for="user in initialUsers" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-12 text-left border-bottom">Target team ({{ channel.target_language1 }} - {{ channel.target_language2 }})</label>
                    <div class="col-sm-12">
                        <select v-model="users2" multiple>
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
        props: ['initialUsers', 'channel'],

        data() {
            return {
                name: '',
                users: []
            }
        },

        methods: {
            createGroup() {
                axios.post('/groups', {users: this.users1, users2: this.users2, channel: this.channel})
                .then((response) => {
                    this.name = '';
                    this.users = [];
                    Bus.$emit('groupCreated', response.data);
                });
            }
        }
    }
</script>
