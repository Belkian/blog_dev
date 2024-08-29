import axios from 'axios'
axios.defaults.xsrfCookieName = 'csrftoken'
axios.defaults.xsrfHeaderName = 'X-CSRFToken'

export default axios.create({
    baseURL: 'http://localhost:8001',
    timeout: 30000,
    headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
    }
})