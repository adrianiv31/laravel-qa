<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form v-show="authorize('modify',question) && editing" class="card-body" @submit.prevent="update">
                    <div class="card-title">
                        <input type="text" class="form-control form-control-lg" v-model="title">
                    </div>
                    <hr>
                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <m-editor :body="body" :name="uniqueName">
                                    <textarea rows="10" v-model="body" class="form-control" required></textarea>
                                </m-editor>
                            </div>
                            <button class="btn btn-primary" type="submit" :disabled="isInvalid">Update</button>
                            <button @click="cancel" class="btn btn-outline-secondary" type="button">Cancel</button>
                        </div>
                    </div>
                </form>
                <div v-show="!editing" class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ title }}</h1>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">Back to
                                    all
                                    questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <vote :model="question" name="question"></vote>
                        <div class="media-body">
                            <div v-html="bodyHtml" ref="bodyHtml"></div>
                            <div class="row">
                                <div class="col-4">
                                    <a v-if="authorize('modify',question)" @click.prevent="edit"
                                       class="btn btn-sm btn-outline-info">Edit</a>
                                    <button v-if="authorize('deleteQuestion',question)"
                                            class="btn btn-outline-danger btn-sm"
                                            @click="destroy">Delete
                                    </button>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info :model="question" label="asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import modification from "../mixins/modification";


    export default {
        props: ['question'],

        mixins: [modification],

        data() {
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                id: this.question.id,
                beforeEditCache: {}
            }
        },

        computed: {
            isInvalid() {
                return this.body.length < 10 || this.title.length < 10;
            },

            endpoint() {
                return `/questions/${this.id};`
            },

            uniqueName(){
                return `question-${this.id}`;
            }
        },

        methods: {
            setEditCache() {
                this.beforeEditCache = {
                    body: this.body,
                    title: this.title
                };
            },

            restoreFromCache() {
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
            },

            payload() {
                return {
                    body: this.body,
                    title: this.title
                }
            },

            delete() {
                axios.delete(this.endpoint)
                    .then(({data}) => {
                        this.$toast.success(data.message, "Success", {timeout: 2000});
                    });
                setTimeout(() => {
                    window.location.href = "/questions";
                }, 3000);
            }
        }
    }
</script>

<style scoped>

</style>
