import {writable} from "svelte/store";

export const currentUser = writable(null);

export async function fetchCurrentUser() {
  try {
    const res = await fetch('/api/logged_in_user', {
      credentials: 'include'
    });
    if (res.ok) {
      const user = await res.json();
      currentUser.set(user);
    } else {
      currentUser.set(null);
    }
  } catch {
    currentUser.set(null);
  }
}
