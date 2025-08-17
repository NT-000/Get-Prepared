
function firstItem<T> (items: T[]): T[] {
    return items.slice(0,1);
}

function firstItem2<T> (items: T[]): T[] {
    return [items[0]];
}

console.log(firstItem2([1, 2, 3]));
console.log(firstItem2(["a", "b", "c"]));