import sys
import datetime

from items import Book, Library, Patrons
from items import my_lib

"""
To do List:

{Book}
    OK Register New Book.
    OK Retire a book
    
Search
    OK List Books by Name give: ID, Name, Author.
    OK List Books by Author give: ID, Name, Author.
    OK List Books by Subject give: ID, Name, Author.

{Shelf}
    OK List Books that are in a shelf by: ID, Name, Author.
    OK Set and Change book's shelf by ID.
    OK Find in which shelf a book is.

{Patrin}
    OK New Patrin
    OK Book Out.
        OK Notify if a patrons have more than 5 books.
    OK Book In.
    OK List books a patrons have.
    OK List patrons that have exceeded due date.
"""

#_______________________________________________________________________

class Menu:
    """Display a menu and respond to choices when run."""
    
    def __init__(self):
        self.library  = Library() 
        self.register = Patrons.patrons_dict
        
        self.choices = {
            '0': self._quit,
            '1': self.menu_book,
            '2': self.search_book,
            '3': self.look_id,
            '4': self.menu_shelfs,
            '5': self.menu_patrin,
            '6': self.new,
            '7': self.retire,
            '8': self.run,
            '9': self.menu_shelfs,
            '10': self.book_shelf,
            '11': self.books_in_shelf,
            '12': self.set_shelf,
            '13': self.register_patron,
            '14': self.book_checkout,
            '15': self.book_checkin,
            '16': self.patrons_books,
            '17': self.overdue,

        }

    def _quit(self):
        print("Thank you for using Birzebbugia Library.")
        sys.exit(0)
#_______________________________________________________________________

    def menu_book(self):

        print("""

'6' Enter a new book
'7' Retire  a book
'8' Return to menu

        """)

        while True:
            choice2 = input('Enter an option\n')
            action2 = self.choices.get(choice2)
            if action2:
                action2()
            else:
                print("'{0}' is not a valid choise".format(choice2))
#_______________________________________________________________________
    
    def search_book(self):
        choice = input('Name, Author or Subject\n')
        books_list = self.library.search(choice)
        print("\n")
        for book in books_list:
            print(
                f"{book.id} {book.bookname} {book.author} {book.subject}"
            )
        self.run()      
#_______________________________________________________________________

    def look_id(self):
        choice3 = int(input('Enter book ID\n'))
        
        book = self.library._find_book(choice3)
        print(
    f"""
    ID:         {book.id}
    Name:       {book.bookname}
    Author:     {book.author}
    Subject:    {book.subject} 
    Shelf:      {book.shelf}
    Patrons ID: {book.patrons_id}

    Check Out:  {book.check_out_date}
    Due Date:   {book.due_date}
    """
            )           
        self.run()     
#_______________________________________________________________________

    def menu_shelfs(self):
        print("""

'10' Find Book shelf
'11' List Book in a shelf
'12' Set Shelf

        """)
        choice = input('Enter an option\n')
        action = self.choices.get(choice)
        action()
#_______________________________________________________________________

    def menu_patrin(self):
        print("""
    
    13. Register Patrin
    14. Book check out
    15. Book check In
    16. Patrin's books
    17. Overdue Patrins
        """)
        
        
        choice = input('Enter an option\n')
        action = self.choices.get(choice)
        action()
#_______________________________________________________________________

    def new(self):
        n = input('Title:\t')
        a = input('Author:\t')
        s = input('Subject:')
        y = input('Year:\t')
        p = input('Pages:\t')
        x = input('Shelf:\t')
        self.library.new_book(n, a, s, y, p, x)
        print(self.library.books)
        self.run()       
#_______________________________________________________________________

    def  retire(self):
        choice = int(input('Enter book ID\n'))
        book = self.library._find_book(choice)

        book.check_out_date = 'retire'
        book.due_date = 'retire'
        book.patrons_id = 'retire'
        book.shelf = 'retire'
        self.run()
#_______________________________________________________________________
 
    def run(self):

        while True:
            print(
                """
    Menu
    '0' Quit
    '1' Register
    '2' Search
    '3' Book info
    '4' Shelf
    '5' Patrin       
    """
            )
            choice1 = input('Enter an option\n')
            action1 = self.choices.get(choice1)
            if action1:
                action1()
                break
            else:
                print("'{0}' is not a valid choise".format(choice1))
#_______________________________________________________________________
    
    def book_shelf(self):
        choice = int(input('Enter book ID\n'))
        book = self.library._find_book(choice)
        print(
            f"{book.shelf}, {book.id}, {book.bookname}, {book.author}"
        )
        self.run()
#_______________________________________________________________________

    def books_in_shelf(self):
        choice = input('Enter Shelf\n')
        books_shelf = self.library.books_in_shelf(choice)
        print(books_shelf)
        
        for book in books_shelf:
            print(
f"{book.shelf} {book.id} {book.bookname} {book.author} {book.subject}"
            )
#_______________________________________________________________________

    def set_shelf(self):
        choice = int(input('Enter book ID\n'))        
        _shelf= input('Set book shelf to: ')        
        self.library.set_shelf(choice, _shelf)
#_______________________________________________________________________
 
    def register_patron(self):
        
        name = input('Name: ')
        surname = input('Surname: ')
        patrin_id = input('ID: ')
        self.patron = Patrons(name, surname, patrin_id)
        print(
f"\nREGISTERED - {self.patron.full_name} {self.patron.id_number}\n"
        )
        self.run()      
#_______________________________________________________________________


    def book_checkout(self):


        def _continue():
            choise = input("Press 'c' to continuew / 'm' return to main menu\n")

            if choise == 'c':
                next_book() 
            elif choise == 'm':
                self.run() 
            else:
                self._quit()

        def next_book():
            
            bookid = input('Book ID: ')

            try:
                bookid = int(bookid) 
            except:
                print('Invalid book id')
                _continue()

            book = self.library._find_book(bookid)
            if not book:
                print('Invalid book id')
                _continue()
            print(f'\n{book.bookname}\n')
            
            if book.check_out_date != 'in Library':
                print("Invalid book id - book not in library")
                
                _continue()        
           
            
            patronid = input('Patron ID: ')
            patron_name = self.register.get(patronid, None)
            if not patron_name:
                print("Invalid Patron id")
                _continue()
            print(f'\n{patron_name}\n')

            qty = len(self.library.check_patrons(patronid ))
            if qty >= 5:
                print('Patron reached maximum book\'s limit')

            self.library.check_out(bookid, patronid)
            _continue()

        next_book()

#_______________________________________________________________________

    def book_checkin(self):

        def _continue():
            choise = input("Press 'c' to continuew / 'm' return to main menu\n")

            if choise == 'c':
                next_book() 
            elif choise == 'm':
                self.run() 
            else:
                self._quit()       


        def next_book():            
            bookid = int(input('Book ID: '))

            book = self.library._find_book(bookid)
            if not book:
                print('Invalid book id')
                _continue()
            print(f'\n{book.bookname}\n')

            if book.check_out_date == 'in Library':
                print("Invalid book id - is in library")
                _continue()

            self.library.check_in(bookid)
            _continue()

        next_book()
#_______________________________________________________________________      

    def patrons_books(self):
        patronid = input('Patron ID: ')
        bookslist = self.library.check_patrons(patronid)
        patron_name = self.register.get(patronid, None)
        if not patron_name:
            print("Invalid Patron id")
            self.run()
            
        print(f'\n{patron_name} {patronid}\n')
        for book in bookslist:
            x = book.due_date
            print(
f"Due Date:\
 {x.strftime('%d %B %Y')}     {book.id} {book.bookname} {book.author}"
            )
        self.run()               
#_______________________________________________________________________

    def overdue(self):
        print("Over due book:-")
        overdue_list = [
x for x in self.library.books if x.due_date != 'in Library' if x.due_date < datetime.datetime.now()
        ]

        for book in overdue_list:
            print(
f"Due Date:  {book.due_date.strftime('%d %B %Y')}   Patron:  {book.patrons_id} \
{Patrons.patrons_dict.get(book.patrons_id)} \
    Book:  {book.id} {book.bookname} {book.author}"
            )
        
        self.run()
#_______________________________________________________________________

        
    def cheat(self):
        """Create a list of books and patrons as a sample to test class. 
           Need to update paths accordingly. 
        """
        path1 = \
        "P:\\Projects\\OOP3\\chapter02\\library_project\\books.txt" 
        path2 = \
        "P:\\Projects\\OOP3\\chapter02\\library_project\\patrons.txt"
        
        with open(path1) as p:
            for _ in range(6):
                line = p.readline()
                line_list = [ a.strip('" \n') for a in line.split(",")]            
                self.library.new_book(*line_list)
                book = self.library.books[-1]

                print(f"\nBOOK - {book.id, book.bookname}")            

        with open(path2) as p: 
            for _ in range(3):
                patron = p.readline() 
                parton_list = patron.split(',')
                pl = [p.strip(" ' \n \"") for p in parton_list]
                self.patron = Patrons(*pl)

                print(
    f"\nPATRON - {self.patron.id_number}, {self.patron.full_name}"
                )

        self.run()        
#_______________________________________________________________________






    
        
    