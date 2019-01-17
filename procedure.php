create PROCEDURE home()
BEGIN
/* 0. All Category */
SELECT * FROM categories ORDER by name asc;

/* 0. All SubCategory */
SELECT * FROM subcategories ORDER by name asc;

SELECT p.id, p.title, p.price, p.discount, p.picture1, p.picture2, p.picture3, c.name cname, sc.name scname, 
		u.name uname
FROM products p, categories c, subcategories sc, units u
where p.Subcategory_id = sc.id and
sc.Category_id = c.id AND
p.Unti_id = u.id
order by p.id DESC
LIMIT 12
;
END


