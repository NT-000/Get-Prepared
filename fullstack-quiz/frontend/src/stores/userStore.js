import {writable} from "svelte/store";

export const currentUser = writable(null);
export const guest = writable(null)

export async function fetchGuestUser(){
    const res = await fetch('/api/logged_in_guest', {
        method: 'POST',
      credentials: 'include'
    });
   const data = await res.json();
   if (data.success){
       guest.set({id: data.id, username: data.username});
   }else{
       guest.set(null)
   }
}

export async function fetchCurrentUser() {

    const res = await fetch('/api/logged_in_user', {
        method: 'POST',
      credentials: 'include',
    });
       const data = await res.json();
   if (data.success){
       currentUser.set({ id: data.id, username: data.username });
   } else {
       currentUser.set(null);
   }

}
