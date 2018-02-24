<template>
    <div class="col-lg-12">
        <div class="box box-success direct-chat direct-chat-success">
            <div class="box-header with-border">
                <h3 class="box-title">Direct Chat</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div v-for="(message, index) in messages" :class="'direct-chat-msg ' + ((index % 2) != 0 ? 'right' : '')">
                        <div class="direct-chat-info clearfix">
                            <span :class="'direct-chat-name pull-' + ((index % 2) == 0 ? 'left' : 'right')">{{ message.user.name }}</span>
                            <span :class="'direct-chat-timestamp pull-' + ((index % 2) == 0 ? 'right' : 'left')">{{ message.created_at }}</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img class="direct-chat-img" src="/img/avatar.jpeg" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            {{ message.message }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input v-model="new_message" type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-success btn-flat" @click.prevent="sendMessage">Send</button>
                          </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                new_message: '',
                messages: [],
            }
        },
        methods: {
            sendMessage () {
                var data = {
                    message: this.new_message,
                };
                axios.post('/api/chat_messages', data)
                    .then( (response) => {
                        console.log(response.data);
                    })
                    .catch( (error) => {
                        if (error) {
                            console.log(error.response);
                        }
                    });
            }
        },
        mounted() {
            axios.get('/api/chat_messages')
                .then( (response) => {
                    this.messages = response.data;
                    console.log(response.data);
                })
                .catch( (error) => {
                    if (error) {
                        console.log(error.response);
                    }
                });
        }
    }
</script>
