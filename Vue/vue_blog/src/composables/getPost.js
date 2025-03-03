import {ref} from "vue";
import { doc, getDoc } from "firebase/firestore";
import {projectFirestore} from "@/firebase/config.js";

const getPost = (id) => {

  const post = ref(null)
  const error = ref(null)
  const load = async () => {
    try {
    const docRef = doc(projectFirestore, "posts", id )
      console.log('response post',docRef)
      const response = await getDoc(docRef);
    const data = response.data()
      post.value = {
      ...data,
        id: response.id,
        createdAt: new Date(data.createdAt.seconds * 1000).toLocaleString()
      }
    } catch (err) {
      error.value = err.message;
      console.log(error.value)
    }
  }
  return {post, error, load}
}

export default getPost

