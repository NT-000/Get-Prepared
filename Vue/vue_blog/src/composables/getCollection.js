import {ref} from 'vue'
import {projectFirestore} from "@/firebase/config.js";
import {collection, onSnapshot, query, orderBy} from "firebase/firestore";

const getCollection = (collectionName) => {
  const documents = ref(null)
  const error = ref(null)
  const collectionRef = query(collection(projectFirestore, collectionName),
    orderBy("createdAt"))



onSnapshot(
  collectionRef,
  (snapshot) => {
  let results = [];
  snapshot.docs.forEach((doc) => {
    doc.data().createdAt && results.push({...doc.data(), id: doc.id, createdAt: new Date(doc.data().createdAt.seconds * 1000).toLocaleString()})
  })
    documents.value = results;
    error.value = null;
}, (err) => {
    console.log(err.message);
    documents.value = null
    error.value = 'could not fetch collection'
  })

  return {documents, error}
}

export default getCollection
