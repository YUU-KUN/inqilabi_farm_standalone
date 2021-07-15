import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
  		status: '',
  		token: localStorage.getItem('Authorization') || '',
  		user : {},
	},
	mutations: {
		auth_request(state){
	    	state.status = 'loading'
	  	},
	  	auth_success(state, token){
		    state.status = 'success'
		    state.token = token
		},
		userDetail(state, user){
			state.user = user
		},
	  	auth_error(state){
	    	state.status = 'error'
	  	},
	  	logout(state){
	    	state.status = ''
			state.token = ''
			state.user = []
	  	},
	},
	actions: {
	  	login({commit}, user){
	        return new Promise((resolve, reject) => {
	            commit('auth_request')
	            // axios({url: 'login_user', data: user, method: 'POST' })
				axios.post('login', user)
				// axios.post('https://inqilabifarm.com/api/login', user)
	            .then(response => {
					if (response.data.status) {
						const token = response.data.user.access_token
						localStorage.setItem('Authorization', token)
						axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('Authorization')
						commit('auth_success', token)
						//get detail user
						let conf = { headers : {"Authorization" : "Bearer " + token} };
						axios.get("/profile", conf)
						.then(response => {
							//simpan detail login ke state
							commit('userDetail', response.data.user)
						}).catch(error => {
							console.log(error.response)
						})
					}
	                resolve(response)
	            })
	            .catch(err => {
					console.log(err.response);
	                commit('auth_error')
	                localStorage.removeItem('Authorization')
	                reject(err)
	            })
	        })
	    },
	  	logout({commit}){
		    return new Promise((resolve, reject) => {
		      	commit('logout')
		      	localStorage.removeItem('Authorization')
		      	delete axios.defaults.headers.common['Authorization']
		      	resolve()
		    })
	  	}
	},
	getters : {
	  isLoggedIn: state => !!state.token,
	  authStatus: state => state.status,
	  userDetail: state => state.user
	}
})
