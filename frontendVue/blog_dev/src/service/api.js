import axios from 'axios'
axios.defaults.xsrfCookieName = 'csrftoken'
axios.defaults.xsrfHeaderName = 'X-CSRFToken'

export default axios.create({
    baseURL: 'https://localhost:8000',
    timeout: 30000,
    headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
    }
})