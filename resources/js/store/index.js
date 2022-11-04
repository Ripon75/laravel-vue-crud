import { createStore } from 'vuex'

const store = createStore({
  state: {
    // default variable
    token: localStorage.getItem('token') || 0
  },
  mutations: {
    //Update variable value
    UPDATE_TOKEN(state, payload) {
        state.token = payload
    }
  },
  actions: {
    // action to be perfomed
    setToken(context, payload) {
        localStorage.setItem('token', payload);
        context.commit('UPDATE_TOKEN', payload)
    },
    removedToken(contex) {
        localStorage.removeItem('token')
        contex.commit('UPDATE_TOKEN', 0)
    }
  },
  getters: {
    // get state variable value
    getToken: function(state){
        return state.token
    }
  }
})

export default store;