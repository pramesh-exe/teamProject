<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRIBUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="main.css">
</head>

<body class="flex flex-col min-h-screen">
    <?php 
        include "./header.php"; 
   
    ?>

    <!-- CONTENT -->
    <div class="flex justify-center md:pl-72 py-4">
        <section class="bg-gradient-to-r from-slate-100 to-sky-100 border rounded-lg mr-4">
            <div class="py-4 lg:py-8 px-4 mx-auto ">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 ">Pricing</h2>
                At Tribus, we believe in providing fair and transparent pricing for our wide range of products. We
                strive to offer competitive prices while maintaining the highest quality standards. Discover the value
                we bring to your shopping experience with our straightforward pricing options:

                <div class="flex-col text-justify mt-14">
                    <div class="grid grid-cols-2 gap-8 mb-4">
                        <div>
                            <span class="block text-xl font-bold">Affordable Range</span>
                            <p>
                                We offer an affordable range of products to suit various budgets without compromising on
                                quality. From everyday essentials to premium items, we have carefully curated a
                                collection that caters to your diverse needs..</p>
                        </div>
                        <div>
                            <span class="block text-xl font-bold">Competitive Pricing</span>
                            <p>
                                Our prices are highly competitive in the market, ensuring that you get the best value
                                for your money. We continuously monitor and adjust our prices to stay in line with
                                industry standards and offer you the most competitive deals.</p>

                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-8 mb-4">
                        <div>
                            <span class="block text-xl font-bold">Discounts and Promotions</span>
                            <p>
                                Stay updated with our latest discounts and promotions to enjoy even greater savings on
                                your purchases. We frequently offer special deals, seasonal discounts, and exclusive
                                promotions, allowing you to maximize your shopping experience and save money.</p>
                            promotions, allowing you to maximize your shopping experience and save money.</p>
                        </div>
                        <div>
                            <span class="block text-xl font-bold">Price Match Guarantee</span>
                            <p>
                                We are confident in our pricing strategy and strive to provide the best prices for our
                                customers. In the rare event that you find a lower price for the same product elsewhere,
                                we offer a price match guarantee. Simply reach out to our customer support team, and
                                we'll match the price to ensure you receive the best deal.</p>
                        </div>
                    </div>
                    <div>
                        <span class="block text-xl font-bold text-center">Transparent Pricing</span>
                        <p>
                            We believe in transparency, which is why all our prices are clearly displayed for each
                            product. You can easily compare prices, make informed decisions, and shop with confidence,
                            knowing that there are no hidden costs or surprises during checkout.</p>
                    </div>

                </div>
                <p class="font-medium mb-4 mt-14">Shop with Tribus and experience hassle-free shopping with fair and
                    transparent pricing. We are committed to offering you the best shopping experience and ensuring that
                    you get the products you need at the most competitive prices.</p>
                <p class="font-light font-sans">Note: Prices are subject to change based on market fluctuations and
                    product availability. Please refer to our website or contact our customer support team for the most
                    up-to-date pricing information.</p>


            </div>
        </section>
    </div>

</body>

<!-- Footer -->
<?php include "footer.php"; ?>

</html>