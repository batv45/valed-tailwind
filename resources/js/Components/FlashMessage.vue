<template>

</template>

<script setup>

const flash = () =>  {
    if (this.$page.props.user && this.$page.props.user.settings) {
        this.$notyf.options.position.y = this.$page.props.user.settings.notyf_yposition
            ? this.$page.props.user.settings.notyf_yposition
            : 'bottom';
        this.$notyf.options.position.x = this.$page.props.user.settings.notyf_xposition
            ? this.$page.props.user.settings.notyf_xposition
            : 'right';
    }
    for (let notyf of this.notifications) {
        if (notyf.type === 'danger')
            notyf.type = 'error';
        if (notyf.dismissible) {
            notyf.duration = 0;
        }
        this.$notyf.open(notyf);

    }
    this.notifications.splice(0,this.notifications.length);
}
</script>

<style scoped>

</style>
