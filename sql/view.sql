CREATE VIEW relatorio_livros AS
SELECT
    GROUP_CONCAT(authors.Nome ORDER BY authors.Nome ASC SEPARATOR ', ') AS autores,
    books.Titulo,
    books.Editora,
    books.Edicao,
    books.AnoPublicacao,
    books.Preco,
    GROUP_CONCAT(subjects.Descricao ORDER BY subjects.Descricao ASC SEPARATOR ', ') AS assuntos
FROM books
JOIN author_book ON books.CodI = author_book.Livro_CodI
JOIN authors ON authors.CodAu = author_book.Autor_CodAu
JOIN book_subject ON books.CodI = book_subject.Livro_CodI
JOIN subjects ON subjects.CodAs = book_subject.Assunto_CodAs
GROUP BY books.Titulo,
    books.Editora,
    books.Edicao,
    books.AnoPublicacao,
    books.Preco;

