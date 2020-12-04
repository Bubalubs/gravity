<template>
    <li :class="{ 'is-active': (item.path == currentPath) }">
        <a :href="item.path" :class="{ 'is-active': (item.path == currentPath) }">
            {{ item.label }}
        </a>

        <div class="menu-toggle" @click="showChildren = !showChildren">
            <span v-if="showChildren">&ndash;</span>
            <span v-if="!showChildren">&#x2b;</span>
        </div>

        <ul v-if="item.children.length > 0 && showChildren">
            <li v-for="childItem in item.children" :key="childItem.label" :class="{ 'is-active': (item.path == currentPath) }">
                <a :href="childItem.path" :class="{ 'is-active': (childItem.path == currentPath) }">
                    {{ childItem.label }}
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        props: [
            'item',
            'currentPath'
        ],

        data() {
            return {
                showChildren: false
            }
        }
    }
</script>