import axios from 'axios';
import { apiUrl } from '../../config/base';

console.log(apiUrl);

/**
 * Create axios
 */
export const http = axios.create({
	baseURL: apiUrl
});

http.defaults.headers.common = {
	'X-CSRF-TOKEN': window.Laravel.csrfToken,
	'X-Requested-With': 'XMLHttpRequest'
};

// handle all error
http.interceptors.response.use(function (response) {
	return response;
}, function (error) {
	const { response } = error;

	if ([401].indexOf(response.status) >= 0) {
		if (response.status == 401) {
			alert(response.data.msg);
			window.open('/');
		}
	}

	if ([403].indexOf(response.status) >= 0) {
		console.log(response.data.message);
	}

	return Promise.reject(response);
});

export default function install(Vue) {
	Object.defineProperty(Vue.prototype, '$http', {
		get() {
			return http;
		}
	});
}