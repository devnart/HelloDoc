<template>

    <div class="card">
        <i :class="icon"></i>
        <h2>{{ title }}</h2>
    </div>
    
</template>

<script>

export default ({
    props: ['title','icon'],
    data() {
        return {
            
        }
    },
})
</script>

<style scoped>
.card {
    transition: 300ms;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background:#f5f5f5;
    width:350px;
    height: 350px;
    border-radius: 10px;
    text-decoration: none;

}
.card:hover {
    transform: scale(1.03);
    background:#77ACF1;
}
.card:hover i ,.card:hover h2 {
    color: white;
}
.card i {
    font-size: 55px;
}
.router-link-active {
    text-decoration: none;
}

</style>