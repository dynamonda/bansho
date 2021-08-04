<template>
    <div class="card">
        <div class="card-header">Card Component</div>
        <div class="card-body">
            I'm an example component.
        </div>
        <form>
            <button type='button'>クリック</button>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Card mounted.')
        }
    }
</script>
