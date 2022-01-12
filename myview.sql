drop view v_salesorder;

create view v_salesorder 
as 
SELECT salesorder.orderid,empname,custname,orderdate,descript,sum(qty*unitprice*discount) as amount
FROM salesorder,orderdetail,employee,customer,product
WHERE salesorder.EmpId=employee.EmpId
 and salesorder.CustId=customer.CustId
 and salesorder.OrderId=orderdetail.OrderId
 and orderdetail.ProdId=product.ProdID
 group by salesorder.orderid,empname,custname,orderdate,descript;