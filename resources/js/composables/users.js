import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useUsers() {
    const users = ref([])
    const company = ref([])
    const router = useRouter()
    const errors = ref('')

    const getUsers = async () => {
        let response = await axios.get('/api/users')
        users.value = response.data.data;
    }
    const destroyUsers = async (id) => {
        await axios.delete('/api/users/' + id)
    }


    return {
        users,
        company,
        errors,
        getUsers,
        destroyUsers
    }
}
