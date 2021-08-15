<template>
    <div class="card">
        <div class="card-header">Example Component</div>

        <div class="card-body">
            <p>I'm an example component.</p>
            <p>{{ profile }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            profile: {
                type: Object
            },
            mounted() {
                console.log('Component mounted.')
            }
        }
    }
</script>
