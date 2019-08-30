import datetime

book_id = 0


class Book:
    """Represent a book in a library. Takes bookname, author, subject, 
    year & pages as parameters."""

    def __init__(self, bookname, author, subject, year, pages, shelf='0'):
        
        self.bookname = bookname
        self.year = year 
        self.pages = pages
        self.check_out_date = 'in Library'
        self.due_date = 'in Library'

        self.patrons_id = None

        self.shelf = shelf
        
        global book_id 
        book_id += 1
        self.id = book_id

        self.author = author 
        
        self.subject = subject  

    def match(self, filter):
        """Determin if this note matches the filter
        text. Return True if it matches, False otherwise.
        
        Search is case sensitive and matches both text and
        tags."""
        return filter in self.bookname or filter in self.author or \
                filter in self.subject

    
#_______________________________________________________________________

    
class Library:
    """Represent a collection of items, books, magazines and disks. 
       That can be searched and taged in/out with date.
       It can retrieve book in shelves and vs. 
       And items lend to Patrons.
       
       (for the purpose of this exercise we only including the books.)"""

    def __init__(self):
        """Initialize a library with empty lists.""" 

        self.books = []
        self.magazines = [] 
        self.disks = []
        

    def new_book(self, bookname, author, subject, year, pages, shelf=''):
        """Create a new book and add it to books list""" 
        self.books.append(Book(
            bookname, author, subject, year, pages, shelf
        ))


    def _find_book(self, book_id):
        """Find book in library by id (This is an internal function)."""
        for book in self.books:
            if book.id == book_id:
                return book 
        return None

    
    def search(self, filter):
        """Find a book by Name, Author or Subject"""
        return [book for book in self.books if book.match(filter)]


    def set_shelf(self, book_id, shelf):
        """Set or change book's shelf."""
        for book in self.books:
            if book.id == book_id:
                book.shelf = shelf 
                print(
f"{book.shelf} {book.id} {book.bookname} {book.author} {book.subject}"
                )

    def find_shelf(self, book_id):
        """Find a book shelf by book_id"""
        for book in self.books:
            if book.id == book_id:
                print(book.shelf) 


    def books_in_shelf(self, shelf_name):
        """List books in specified shelf by shelf_name"""
        return [book for book in self.books if book.shelf == shelf_name]


    def check_out(self, book_id, patrons_id):
        """Set a book as taken by a patron by book_id and patrons_id.
           Also  set check_out_date and due_date."""
        for book in self.books:
            if book.id == book_id:
                book.patrons_id = patrons_id
                book.check_out_date = datetime.datetime.now() 
                book.due_date = (
                    datetime.datetime.now() + datetime.timedelta(days=15)
                ) 

    def check_in(self, book_id):
        for book in self.books:
            if book.id == book_id:
                book.patrons_id = None
                book.check_out_date = 'in Library'
                book.due_date = 'in Library'


    def check(self, book_id): 
        for book in self.books: 
            if book.id == book_id: 
                return f"check out: {book.check_out_date}\
                    due date : {book.due_date}" 

    def check_patrons(self, id_patrons):
        """List books a patrons have.
           (nb: this need to be used to set patrons' books limit)."""
        return [
            book for book in self.books if book.patrons_id == id_patrons
        ]

#_______________________________________________________________________

class Patrons:
    """Represent an patrons that is registered with the library.
    Takes a name surname and id_number"""

    patrons_dict = {}

    def __init__(self, name, surname, patrons_id):
        self.full_name = name + ' ' + surname 
        self.id_number = patrons_id
        Patrons.patrons_dict.update({self.id_number: self.full_name})

    def find_patrons(self, patrons_id):
        return Patrons.patrons_dict.get(patrons_id)


#_______________________________________________________________________

my_lib = Library() 



# path = "P:\\Projects\\OOP3\\chapter02\\library_project\\samples.txt"

# with open(path) as p:
#     for _ in range(6):
#             line = p.readline()
#             line_list = [ a.strip('" \n') for a in line.split(",")]            
#             my_lib.new_book(*line_list)

import os 
cls = lambda: os.system('cls')

# from items import cls, Library, Patrons, Book, my_lib
# chris = Patrons('Chris', 'Farrugia', '397284m')
# james = Patrons('James', 'Borg', '269871m')
# dorothy = Patrons('Dorothy', 'Cassar', '123456m')