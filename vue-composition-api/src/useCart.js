import { ref } from "vue"

export default function useCart(){
    const items = ref([])

    const addItem = (item) => items.value.push(item)

    const removeItem = (item) => {
        const index = items.value.findIndex (i => i.id = item.id)
        items.value.splice(index, 1)
    }

    return {
        items,addItem,removeItem
    }
}