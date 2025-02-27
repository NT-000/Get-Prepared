import {ref} from "vue";

const getPosts = () => {

  const posts = ref([])
  const error = ref(null)
  const load = async () => {
    try {
      let data = await fetch('http://localhost:3001/posts')
      if (!data.ok) {
        throw Error('data not okay')
      }
      posts.value = await data.json()
    } catch (err) {
      error.value = err.message;
      console.log(error.value)
    }
  }
  return {posts, error, load}
}

export default getPosts
