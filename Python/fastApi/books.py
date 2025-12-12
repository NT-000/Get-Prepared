from fastapi import FastAPI,Body, HTTPException
app = FastAPI()

BOOKS = [
	{
		'id': 1,
		'title': 'The Silent Algorithm',
		'author': 'Elena Morris',
		'description': 'A suspenseful tech thriller about an AI system that begins making decisions no human can fully explain.',
		'price': 299,
		'category': 'crime'
	},
	{
		'id': 2,
		'title': 'Nordic Nights',
		'author': 'Anders Holm',
		'description': 'A crime novel set in Northern Norway, following a detective uncovering secrets in a small coastal town.',
		'price': 249,
		'category': 'crime'
	},
	{
		'id': 3,
		'title': 'Learning Python the Practical Way',
		'author': 'James R. Keller',
		'description': 'A hands-on guide to Python programming with real-world examples and beginner-friendly explanations.',
		'price': 399,
		'category': 'Programming'
	},
	{
		'id': 4,
		'title': 'Mindful Minutes',
		'author': 'Sarah Lind',
		'description': 'A practical introduction to mindfulness and meditation for people with busy everyday lives.',
		'price': 199,
		'category': 'math'
	},
	{
		'id': 5,
		'title': 'The Last Voyage of Orion',
		'author': 'Anders Holm',
		'description': 'A science fiction adventure about humanity’s first deep-space exploration and the cost of survival.',
		'price': 349,
		'category': 'Bio'
	}
]

@app.get("/books")
async def read_all_books(author: str = None, category: str = None):
	books_to_return = BOOKS

	if author:
		books_to_return = [book for book in books_to_return
		                  if book.get('author').casefold() == author.casefold()]

	if category:
		books_to_return = [book for book in books_to_return
		                  if book.get('category').casefold() == category.casefold()]

	return books_to_return


@app.get("/books/{book_id}")
async def read_book(book_id: int):
	for book in BOOKS:
		if book.get('id') == book_id:
			return book
	raise HTTPException(status_code=404, detail="Book not found")

#POST
@app.post("/books/create_book")
async def create_book(new_book: dict = Body()):
	BOOKS.append(new_book)

@app.put("/books/update_book")
async def update_book(updated_book: dict = Body()):
	for i in range(len(BOOKS)):
		if BOOKS[i].get('title').casefold() == updated_book.get('title').casefold():
			BOOKS[i] = updated_book

@app.delete("/books/delete_book/{id}")
async def delete_book(id: int):
	for i in range(len(BOOKS)):
		if BOOKS[i].get('id') == id:
			BOOKS.pop(i)
			return {'message': 'Book successfully deleted'}
	raise HTTPException(status_code=404, detail="Book not found")