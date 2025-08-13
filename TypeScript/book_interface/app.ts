import {IBook} from "./IBook";

let bookList = []

const bookNameless: IBook = {
    title: 'Book',
    author: '',
}

const bookAuthor : IBook = {
    title: 'Book',
    author: 'Jon Kameleon',
}

bookList.push(bookNameless, bookAuthor)
bookList.forEach(book => {
    if(book.author == '') {
        console.log(`Title: ${book.name} - Author: unknown`)
    }
    else{
        console.log(`Title: ${book.name} - Author: ${book.author}`)
    }

})