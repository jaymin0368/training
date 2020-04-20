Tasks added so far in this repository:

1. Popup login.
 
    a. Upon clicking on “Sign In”, open one popup instead redirecting the customer to the individual page.
    b. Customers can create accounts from the same popup.
    c. All the operations will be done through Ajax.
 
2. Product daily deal - Estimated Hours (15 Hours)
   
   	a. Create one new tab in the Manage product section “Daily Deal”. ---
   
   	b. Add two product attributes “Deal status” as Enable / Disable, and second would be date picker attribute.
   
   	c. Based upon the product setting, add JavaScript timer countdown in product view page.
   
   	d. Remove the counter automatically after the deal ends.
   	
4. Create a script in which we can update qty and stock status using magento default API.

7. Static blocks in custom layout - Estimated Hours (4 hours) - Completed

	a. Create tree static blocks with lorem ipsum values.

	b. Custom Module: On specific action(http://baseurl/yourmodule/controller/action) setup 3-column layout page.

	c. Now, call those static blocks into this page. One in content, second in left, and third one in right Panel

5. Customer Login IP Restriction:
 
    a. Using Rewrite Model/Observers, built a functionality where customers can login with some allowed ip-addresses.
    
    b. In the admin panel, manage this ip-addresses with custom GRID.
    
9. Add one new customer attribute named as “Father’s Name” & “Mother’s Name”
    
    a.Add new customer attribute via UpgradeSchema
    
    b.Ask customers to add “Father’s Name” & “Mother’s Name” when creating a new account from frontend.
    
    c.Display “Father’s Name” & “Mother’s Name” value in backend customer account edit form as well as in frontend, which can be editable.
    
    d.Show attribute value in the customer account area in frontend, customer grid in backend.
    
    e.Add system configuration in Customer Configuration tab for Show “Father’s Name”  as Yes/No option  & “Mother’s Name” as Yes/No option , based on config value of “Father’s Name”  or “Mother’s Name” fields should be displayed or not in customer account create form and account dashboard in store front.
11. Add order Processing Fee to Cart. Estimated Hours - (20 Hours)
    
    a. Add a new configuration in Store >> Configuration >> Sales  >> Order Fees , add two fields “Apply Additional Fee” with “Yes/No” options &  “Order Processing Fee” as a text field to add value in percent for additional fee. (Also show note below field “Add fee in %. This fee will be added to the product price as an additional fee”. 

    b. When any product is added to cart, check if the “Apply Additional Fee” setting is set to “Yes” then add additional fee from configuration “Order Processing Fee”  to subtotal amount.

    c. Same Fee will affect everywhere where order data is associated.

3. Create simple Module - Estimated Hours (12 Hours)
    
    a. Add/Update/Delete Module with following types of input elements: text, checkbox, drop-down, radio, multi-select, text-box, color-selection.
    	
    b.  Grid and Edit/Add Form should be manageable from both admin and front-end.
10. Create a cron, in which the latest products (last 3 days) should get auto-assigned to a category.
    
    a. Maximum number of products in that category should be 10. If there are no more products to assign, then it should persist the last added products.
    
13. Create a custom shipping method with country selection and custom shipping price. - 4 Hours - Completed
