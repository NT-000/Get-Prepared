
function firstItem<T> (items: T[]): T[] {
    return items.slice(0,1);
}

console.log(firstItem([1, 2, 3]));
console.log(firstItem(["a", "b", "c"]));