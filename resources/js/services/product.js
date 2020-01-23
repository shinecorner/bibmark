import axios from 'axios';

export const random = () => {
    return new Promise((res, rej) => {
        axios.get('api/random_product')
            .then(res)
            .catch(rej)
    });
} 