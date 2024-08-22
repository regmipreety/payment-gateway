## Stripe Documentaion: 
<a href="https://docs.stripe.com/payments/accept-a-payment?integration=checkout">Stripe official documentation page.</a>
<table>
<th>
<tr>
<td>Card number	Scenario</td>
<td>How to test</td>
</tr>
</th>
<tr>
<td>4242424242424242</td>
<td>The card payment succeeds and doesn’t require authentication.	Fill out the credit card form using the credit card number with any expiration, CVC, and postal code.</td>
</tr>
<tr>
<td>4000002500003155</td>
<td>The card payment requires authentication.	Fill out the credit card form using the credit card number with any expiration, CVC, and postal code.</td>
</tr>
<tr>
<td>4000000000009995</td>
<td>The card is declined with a decline code like insufficient_funds.	Fill out the credit card form using the credit card number with any expiration, CVC, and postal code.</td>
</tr>
<tr>
<td>6205500000000000004</td>
<td>The UnionPay card has a variable length of 13-19 digits.	Fill out the credit card form using the credit card number with any expiration, CVC, and postal code.</td>
</tr>
</table>
