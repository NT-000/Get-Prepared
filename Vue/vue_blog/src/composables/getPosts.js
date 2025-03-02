import {ref} from "vue";
import { collection, getDocs } from "firebase/firestore";
import {projectFirestore} from "@/firebase/config.js";

const getPosts = () => {

  const posts = ref([])
  const error = ref(null)
  const load = async () => {
    try {
    const response = await getDocs(collection(projectFirestore, 'posts'));
    posts.value = response.docs.map(doc =>{
      const data = doc.data();
      return {
        id: doc.id,
        title: data.title,
        body: data.body,
        tags: data.tags || [],
        time: new Date(data.time.seconds * 1000).toLocaleString()
      }

    })
    console.log(response)

    } catch (error) {
      error.value = error.message;
      console.log(error.value)
    }
  }
  return {posts, error, load}
}

export default getPosts
