import {ref} from "vue";
import {collection, getDocs, onSnapshot, orderBy, query} from "firebase/firestore";
import {projectFirestore} from "@/firebase/config.js";

const getPosts = () => {

  const posts = ref([])
  const error = ref(null)

  const postsQuery = query(collection(projectFirestore, "posts"), orderBy("createdAt", "desc"));

  onSnapshot(postsQuery, (snapshot) => {
    posts.value = snapshot.docs.map((doc) => ({
      ...doc.data(),
      id: doc.id,
      createdAt: new Date(doc.data().createdAt.seconds * 1000).toLocaleString()
    }));
  }, (err) => {
    error.value = err.message;
    console.error("Realtime updates error:", error.value);
  });
  const load = async () => {
    try {
      const q = query(collection(projectFirestore, "posts"), orderBy("createdAt", "desc"));
      const response = await getDocs(q);

      posts.value = response.docs.map(doc => {
        const data = doc.data();
        return {
         ...data,
          id: doc.id,
          createdAt: data.createdAt ? new Date(data.createdAt.seconds * 1000).toLocaleString() : null
        };
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
