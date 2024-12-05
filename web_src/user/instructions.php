<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <!-- Stylesheets -->
    <link href='../css/global.css' rel='stylesheet'>
    <style>
        /* TODO: Add these rules to a stylesheet*/
        td {

            padding: 15px;

        }
        .question {

            background-color: #cccccc;

        }
        .answer {

            background-color: #dddddd;

        }
    </style>
</head>
<body>
    <?php
        /*
        Author: John McGovern, Asher Wayde
        This will provide the recently asked questions from the old site to the new site.
        */
        require_once "navbar.php";

        $lastDay = "Tuesday, May 6th, 2025";
        $volContact = "<a href='mailto:prsnghm@comcast.net'>prsnghm@comcast.net</a>";

    ?>
    <h2>Frequently Asked Questions</h2><br>
    <!-- TODO: Reveiw these to see if they're still relevent -->
    <table>
        <tr>
            <td class = 'question'>Do I have to sell in order to be able to shop?</td>
        </tr>
        <tr>
            <td class = 'answer'>No, you are welcome to come and shop even if you are not interested in selling anything. The sale is for anyone registered to attend the CHAP conference.</td>
        </tr>
        <tr>
            <td class = 'question'>Can I bring unregistered items to sell at the Used Curriculum Sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>No. The last day to register items to be sold is <?php echo $lastDay?>. Item tags must be computer generated. Handwritten tags will not be accepted.</td>
        </tr>
        <tr>
            <td class = 'question'>Why is <?php echo $lastDay?> the last day to register items?</td>
        </tr>
        <tr>
            <td class = 'answer'>CHAP must complete ordering tables and other supplies for the Used Curriculum Sale by this date and therefore must know the expected number of items to be sold.</td>
        </tr>
        <tr>
            <td class = 'question'>May I change information about the item that I am selling after <?php echo $lastDay?>?</td>
        </tr>
        <tr>
            <td class = 'answer'>No. We are sorry but changing items after the cut-off date creates problems for our system.</td>
        </tr>
        <tr>
            <td class = 'question'>May I add additional items to sell after <?php echo $lastDay?>?</td>
        </tr>
        <tr>
            <td class = 'answer'>No.</td>
        </tr>
        <tr>
            <td class = 'question'>Should I hold off registering an item if I plan to sell it through my local homeschool used book sale prior to the CHAP Used Curriculum Sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>No. Please register any items that you are trying to sell. If you sell an item prior to the CHAP Used Curriculum Sale, congratulations! Registering an item does not obligate you to bring it to the CHAP Used Curriculum Sale. Please make sure to cross any pre-sold items or items not brought to the sale off your master inventory list.</td>
        </tr>
        <tr>
            <td class = 'question'>What if I sell my item before the Used Curriculum Sale or decide not to sell my item?</td>
        </tr>
        <tr>
            <td class = 'answer'>Congratulations if you sold it. You are not obligated to sell your item even if you register it. If you choose not to sell an item, simply delete it from your master list.</td>
        </tr>
        <tr>
            <td class = 'question'>May I return items?</td>
        </tr>
        <tr>
            <td class = 'answer'>No, all sales are final.</td>
        </tr>
        <tr>
            <td class = 'question'>How do I pay for my items?</td>
        </tr>
        <tr>
            <td class = 'answer'>Cash, personal checks (made out to CHAP), and credit cards (VISA and MasterCard) are accepted.</td>
        </tr>
        <tr>
            <td class = 'question'>Is there a bag check at the Used Curriculum Sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>There is no bag check.</td>
        </tr>
        <tr>
            <td class = 'question'>Do I have to pick up my items at the end of the Used Curriculum Sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>Only if you want your items back. Before the convention, as you prepare your items for sale, you will designate each item for either "Pick-up" or "Donate".</td>
        </tr>
        <tr>
            <td class = 'question'>What happens to unsold items designated "Donate" or not picked up?</td>
        </tr>
        <tr>
            <td class = 'answer'>On Saturday, May 13, 2025, from 4:00 p.m. until 5:00 p.m., the Used Curriculum Sale area will be open for all CHAP conference attendees to browse or glean through the donated items. Many may find items they could not otherwise afford and be greatly blessed. After 5:00 p.m., all remaining items, "donated" or not picked up, will be donated to various organizations.</td>
        </tr>
        <tr>
            <td class = 'question'>If I sell items, when will I receive a check?</td>
        </tr>
        <tr>
            <td class = 'answer'>You will receive a check approximately six to eight weeks after the convention for 65% of the sale prices of the items sold. The check will be mailed in the self-addressed, stamped envelope which you will provide at the time of drop off of your sale items. Payments will not be made at the convention.</td>
        </tr>
        <tr>
            <td class = 'question'>Why does CHAP retain 35% of my sales?</td>
        </tr>
        <tr>
            <td class = 'answer'>CHAP needs to cover the costs of UCS floor space, UCS table and equipment rental, PA taxes on your items sold at the UCS, and overnight security for UCS items.</td>
        </tr>
        <tr>
            <td class = 'question'>How do I volunteer in the Used Curriculum Sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>Volunteer positions are on a first come, first serve basis. If you would like to be an all day volunteer at the sale, please contact Diana Merkel at <?php echo $volContact?>.</td>
        </tr>
        <tr>
            <td class = 'question'>Why does shopping close so early on Saturday?</td>
        </tr>
        <tr>
            <td class = 'answer'>All of the unsold items have to be resorted and picked up by the sellers by 4:00 p.m. We want to ensure that all remaining items are returned to the sellers.</td>
        </tr>
        <tr>
            <td class = 'question'>Why do some of my tags have an "X" and some of my tags do not?</td>
        </tr>
        <tr>
            <td class = 'answer'>The tags with an "X" indicate that you would like those items returned to you if they do not sell. The tags with an empty box indicate that the items are to be donated if they do not sell.</td>
        </tr>
        <tr>
            <td class = 'question'>Do I need to attend the convention in order to sell my books?</td>
        </tr>
        <tr>
            <td class = 'answer'>You must be a convention attendee or sell your books through someone else who is registered to attend the convention in order to sell books at the CHAP convention.</td>
        </tr>
        <tr>
            <td class = 'question'>Won't the sticky labels mar the front of the items?</td>
        </tr>
        <tr>
            <td class = 'answer'>These are used books. Use your best judgment in where to place the labels on the front of the book (Sellers and volunteers will onlylook for labels on the front cover). The sticky back labels are important to make sure that your book sales are accredited to your account. If there is a label from a previous year, completely cover or remove that label.</td>
        </tr>
        <tr>
            <td class = 'question'>Why must I put the sticky label on the front/top of my items?</td>
        </tr>
        <tr>
            <td class = 'answer'>Having all tags uniformly placed on the front/top of the items ensures that the buyer can find the price of your item, allows for easy check-out, and decreases the chances of your books not being sold. When tags are placed on the back or inside of the books/items, people often assume the tag has fallen off and these items end up in the problem book box where they are not available for sale. If you want your books/items to sell, please place your sticky label on the front/ top of your item.</td>
        </tr>
        <tr>
            <td class = 'question'>Why can't I use easily removable labels?</td>
        </tr>
        <tr>
            <td class = 'answer'>These labels would come off easily during the sale thus making it impossible for us to sell the item and making it very difficult to return the item to the seller at the end of the sale.</td>
        </tr>
        <tr>
            <td class = 'question'>What if I cannot find an item at the end of the sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>Please be sure to check in the Problem Book Box. Many items end up separated from their sets or may lose tags during the sale. These items are placed in the problem book box so their owners can attempt to retrieve them at the end of the sale. CHAP is not responsible for any damaged or missing items.</td>
        </tr>
        <tr>
            <td class = 'question'>Why do I have to help find my own books at the end of the sale?</td>
        </tr>
        <tr>
            <td class = 'answer'>As the sale has increased in the number of items available to be sold, we have discovered that it is impossible to enlist the number of volunteers required to gather the books and redistribute them to their original owners in the time available. To ensure a more efficient retrieval of your items, we are requiring the seller to manage their own boxes and assist in finding and reclaiming their remaining items.</td>
        </tr>
        <tr>
            <td class = 'question'>Why do I have to distribute my books to the tables after I check them in?</td>
        </tr>
        <tr>
            <td class = 'answer'>As the sale has increased in the number of items available to be sold, we have discovered that it is impossible to enlist the number of volunteers required to cost effectively distribute the books. Because the seller has to distribute their own books, CHAP has increased the percentage of the sale that the seller receives.</td>
        </tr>
        <tr>
            <td class = 'question'>Why did the times of the sale change?</td>
        </tr>
        <tr>
            <td class = 'answer'>To reduce the cost of operating the Used Curriculum Sale, the hours were changed to more efficiently use the volunteers. In addition, the hours provide attendees with additional time to explore the Vendor Hall which do not conflict with the Used Curriculum Sale.</td>
        </tr>
    </table>
    <?php
    // adding the footer
    require_once "../footer.php";
    ?>
</body>
</html>