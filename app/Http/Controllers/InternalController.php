<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sponsor;
// use App\Services\BillingService;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BillingResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UploadImageRequest;
use phpDocumentor\Reflection\Types\Integer;
use App\Http\Requests\Billing\{CreateBillingRequest};
use App\Http\Requests\Asset\{CreateOrUpdateAssetRequest};
use App\Http\Requests\Sponsor\{CreateOrUpdateSponsorRequest};
use App\Http\Requests\Charity\{CreateOrUpdateCharityRequest};
use App\Http\Requests\Event\{CreateOrUpdateEventRequest, RegisterEventRequest};
use App\Http\Requests\Design\{CreateOrUpdateDesignRequest, UploadDesignFileRequest};
use App\Http\Requests\Location\{CreateAddressRequest, CreateOrUpdateLocationRequest};
use App\Http\Requests\Product\{CreateOrUpdateProductRequest, AddProductToSizeRequest};
use App\Http\Requests\Order\{CreateOrUpdateOrderItemRequest, UpdateOrderRequest, PlaceOrderRequest};
use App\Http\Requests\User\{LoginRequest, CreateOrUpdateUserUnderSponsorRequest, GetAllUsersRequest, CreateOrUpdateUserRequest};
use App\Http\Resources\{LocationResource, LocationCollection, AddressResource, OrderItemResource, OrderItemCollection, OrderResource, OrderCollection, DesignResource, DesignCollection};
use App\Http\Resources\{SponsorResource, SponsorCollection, CharityResource, CharityCollection, EventResource, EventCollection, UserResource, UserCollection, ProductResource, ProductCollection, AssetCollection, AssetResource};
use App\Services\{SponsorService, CharityService, EventService, UserService, ProductService, LocationService, AddressService, OrderService, BillingService, DesignService, ExtraService, ShippingService, AssetService};

class InternalController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Get all sponsors
     *
     * @param App\Services\SponsorService $sponsorService
     * @return \Illuminate\Http\Response
     */
    public function sponsors(SponsorService $sponsorService)
    {
        $result = new SponsorCollection($sponsorService->getAllSponsors());

        return response()->json($result, 200);
    }

    /**
     * Create or Update an sponsor
     *
     * @param App\Http\Requests\Sponsor\CreateOrUpdateSponsorRequest $request
     * @param App\Services\SponsorService $sponsorService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateSponsor(CreateOrUpdateSponsorRequest $request, SponsorService $sponsorService)
    {
        $result = new SponsorResource($sponsorService->createOrUpdateSponsor($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete an sponsor
     *
     * @param integer $sponsorId
     * @param App\Services\SponsorService $sponsorService
     * @return \Illuminate\Http\Response
     */
    public function deleteSponsor($sponsorId, SponsorService $sponsorService)
    {
        $result = $sponsorService->deleteSponsor($sponsorId);

        return response()->json($result, 200);
    }

    /**
     * Get sponsor details
     *
     * @param integer $sponsorId
     * @param App\Services\SponsorService $sponsorService
     * @return \Illuminate\Http\Response
     */
    public function sponsorDetails($sponsorId, SponsorService $sponsorService)
    {
        $result = new SponsorResource($sponsorService->getSponsorById($sponsorId));

        return response()->json($result, 200);
    }

    /**
     * Get all charities
     *
     * @param App\Services\AssetService $assetService
     * @return \Illuminate\Http\Response
     */
    public function charities(CharityService $charityService)
    {
        $result = new CharityCollection($charityService->getAllCharities());

        return response()->json($result, 200);
    }

    /**
     * Create or Update a charity
     *
     * @param App\Http\Requests\Sponsor\CreateOrUpdateCharityRequest $request
     * @param App\Services\CharityService $charityService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateCharity(CreateOrUpdateCharityRequest $request, CharityService $charityService)
    {
        $result = new CharityResource($charityService->createOrUpdateCharity($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete a charity
     *
     * @param integer $charityId
     * @return \Illuminate\Http\Response
     */
    public function deleteCharity($charityId, CharityService $charityService)
    {
        $result = $charityService->deleteCharity($charityId);

        return response()->json($result, 200);
    }

    /**
     * Get charity details
     *
     * @param integer $charityId
     * @param \App\Services\CharityService $charityService
     * @return \Illuminate\Http\Response
     */
    public function charityDetails($charityId, CharityService $charityService)
    {
        $result = new CharityResource($charityService->getCharityById($charityId));

        return response()->json($result, 200);
    }

    /**
     * Get all events
     *
     * @param App\Services\EventService $eventService
     * @return \Illuminate\Http\Response
     */
    public function events(EventService $eventService)
    {
        $result = new EventCollection($eventService->getAllEvents());

        return response()->json($result, 200);
    }

    /**
     * Create or Update an event
     *
     * @param App\Http\Requests\Event\CreateOrUpdateEventRequest $request
     * @param App\Services\EventService $eventService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateEvent(CreateOrUpdateEventRequest $request, EventService $eventService)
    {
        $result = new EventResource($eventService->createOrUpdateEvent($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete an event
     *
     * @param integer $eventId
     * @param App\Services\EventService $eventService
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent($eventId, EventService $eventService)
    {
        $result = $eventService->deleteEvent($eventId);

        return response()->json($result, 200);
    }

    /**
     * Register an event
     *
     * @param App\Http\Requests\Event\RegisterEventRequest $request
     * @param App\Services\EventService $eventService
     * @return App\Services\EventService $eventService
     */
    public function registerEvent(RegisterEventRequest $request, EventService $eventService)
    {
        $result = $eventService->registerEvent($request->all());

        return response()->json($result, 200);
    }

    /**
     * Get event details
     *
     * @param integer $eventId
     * @param \App\Services\EventService $eventService
     * @return \Illuminate\Http\Response
     */
    public function eventDetails($eventId, EventService $eventService)
    {
        $result = new EventResource($eventService->getEventById($eventId));

        return response()->json($result, 200);
    }

    /**
     * Get all users belong the sponsor
     *
     * @param integer $sponsorId
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function usersWithSponsorId($sponsorId, UserService $userService)
    {
        $result = new UserCollection($userService->usersWithSponsorId($sponsorId));

        return response()->json($result, 200);
    }

    /**
     * Get all users
     *
     * @param App\Http\Requests\User\GetAllUsersRequest $request
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function users(GetAllUsersRequest $request, UserService $userService)
    {
        $search = $request->query('search');
        $result = new UserCollection($userService->users($search));

        return response()->json($result, 200);
    }

    /**
     * Create a user belongs to the sponsor
     *
     * @param App\Http\Requests\User\CreateOrUpdateUserUnderSponsorRequest $request
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateUserUnderSponsor(CreateOrUpdateUserUnderSponsorRequest $request, UserService $userService)
    {
        $result = new UserResource($userService->createOrUpdateUserUnderSponsor($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Create a user
     *
     * @param App\Http\Requests\User\CreateOrUpdateUserRequest $request
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateUser(CreateOrUpdateUserRequest $request, UserService $userService)
    {
        $result = new UserResource($userService->createOrUpdateUser($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete a user
     *
     * @param integer $userId
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($userId, UserService $userService)
    {
        $result = $userService->deleteUser($userId);

        return response()->json($result, 200);
    }

    /**
     * Get a user relations info (Sponsors, Charities, Events)
     * or all Sponsors, Charities, Events, Users if user is admin
     *
     * @param integer $userId
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function dashboardAchievements($userId, UserService $userService)
    {
        $result = $userService->getDashboardAchievements($userId);
        return response()->json($result, 200);
    }

    /**
     * Get all products
     *
     * @param App\Services\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function products(ProductService $productService)
    {
        $result = new ProductCollection($productService->getAllProducts());

        return response()->json($result, 200);
    }

    /**
     * Create or Update a product
     *
     * @param App\Http\Requests\Sponsor\CreateOrUpdateProductRequest $request
     * @param App\Services\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateProduct(CreateOrUpdateProductRequest $request, ProductService $productService)
    {
        $result = new ProductResource($productService->createOrUpdateProduct($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete a product
     *
     * @param integer $productId
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($productId, ProductService $productService)
    {
        $result = $productService->deleteProduct($productId);

        return response()->json($result, 200);
    }

    /**
     * Add a product to a category
     *
     * @param integer $productId
     * @param integer $categoryId
     * @return \Illuminate\Http\Response
     */
    public function addProductToCategory($productId, $categoryId, ProductService $productService)
    {
        $result = $productService->addProductToCategory($productId, $categoryId);

        return response()->json($result, 200);
    }

    /**
     * Delete a product from a category
     *
     * @param integer $productId
     * @param integer $categoryId
     * @return \Illuminate\Http\Response
     */
    public function deleteProductFromCategory($productId, $categoryId, ProductService $productService)
    {
        $result = $productService->deleteProductFromCategory($productId, $categoryId);

        return response()->json($result, 200);
    }

    /**
     * Add a product to a size
     *
     * @param App\Http\Requests\Product\AddProductToSizeRequest $request
     * @param integer $productId
     * @param integer $sizeId
     * @return \Illuminate\Http\Response
     */
    public function addProductToSize(AddProductToSizeRequest $request, $productId, $sizeId, ProductService $productService)
    {
        $quantity = $request->query('quantity', 1);
        $result = $productService->addProductToSize($productId, $categoryId, $quantity);

        return response()->json($result, 200);
    }

    /**
     * Delete a product from a size
     *
     * @param integer $productId
     * @param integer $sizeId
     * @return \Illuminate\Http\Response
     */
    public function deleteProductFromSize($productId, $sizeId, ProductService $productService)
    {
        $result = $productService->deleteProductFromSize($productId, $sizeId);

        return response()->json($result, 200);
    }

    /**
     * Get all locations
     *
     * @param App\Services\LocationService $locationService
     * @return \Illuminate\Http\Response
     */
    public function locations(LocationService $locationService)
    {
        $result = new LocationCollection($locationService->getAllLocations());

        return response()->json($result, 200);
    }

    /**
     * Create or Update a location
     *
     * @param App\Http\Requests\Location\CreateOrUpdateLocationRequest $request
     * @param App\Services\LocationService $locationService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateLocation(CreateOrUpdateLocationRequest $request, LocationService $locationService)
    {
        $result = new LocationResource($locationService->createOrUpdateLocation($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Create an address
     *
     * @param App\Http\Requests\Location\CreateAddressRequest $request
     * @param App\Services\LocationService $locationService
     * @return \Illuminate\Http\Response
     */
    public function createAddress(CreateAddressRequest $request, AddressService $addressService)
    {
        $result = new AddressResource($addressService->createAddress($request->all()));
        return response()->json($result, 200);
    }

    public function getAddress($id){
        $user = User::find($id);

        return $user->address;
    }

    /**
     * Delete a location
     *
     * @param integer $locationId
     * @return \Illuminate\Http\Response
     */
    public function deleteLocation($locationId, LocationService $locationService)
    {
        $result = $locationService->deleteLocation($locationId);

        return response()->json($result, 200);
    }

    /**
     * Get all orders
     *
     * @param App\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function orders(OrderService $orderService)
    {
        $result = new OrderCollection($orderService->getAllOrders());

        return response()->json($result, 200);
    }

    /**
     * Create or Update an order item
     *
     * @param App\Http\Requests\Order\CreateOrUpdateOrderItemRequest $request
     * @param App\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateOrderItem(CreateOrUpdateOrderItemRequest $request, OrderService $orderService)
    {
        $result = new OrderItemResource($orderService->createOrUpdateOrderItem($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Update an order
     *
     * @param App\Http\Requests\Order\UpdateOrderRequest $request
     * @param App\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(UpdateOrderRequest $request, OrderService $orderService)
    {
        $result = new OrderResource($orderService->updateOrder($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Place an order
     *
     * @param App\Http\Requests\Order\PlaceOrderRequest $request
     * @param App\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function placeOrder(PlaceOrderRequest $request, OrderService $orderService)
    {
        $result = new OrderResource($orderService->placeOrder($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Get lowest rate
     *
     * @param integer $orderId
     * @param App\Services\OrderService $orderService
     * @param Illuminate\Http\Request $request
     * @param App\Services\ShippingService $shippingService
     * @return \Illuminate\Http\Response
     */
    public function getLowestCarrierRate($orderId, OrderService $orderService, Request $request, ShippingService $shippingService)
    {
        $totalWeight = $orderService->getTotalWeightItemsInOrder($orderId);
        $shippingMethod = $request->shipping_method ?? null;
        $result = $shippingService->chooseLowestRateFromCarriers($orderId, $totalWeight, $shippingMethod);

        return response()->json(['carrier' => $result->carrier, 'service' => $result->service, 'rate' => $result->rate], 200);

    }

    /**
     * Create a billing
     *
     * @param App\Http\Requests\Billing\CreateBillingRequest $request
     * @param App\Services\BillingService $billingService
     * @return \Illuminate\Http\Response
     */
    public function createBilling(CreateBillingRequest $request, BillingService $billingService)
    {
        $result = new BillingResource($billingService->createBilling($request->all()));

        return response()->json($result, 200);
    }

    // Update
    public function updateBilling(CreateBillingRequest $request, BillingService $billingService)
    {
        $result = new BillingResource($billingService->createBilling($request->all()));
        $card_id = $request->card_id;
        $oldCard = Billing::find($card_id);
        $oldCard->delete();
        return response()->json($result, 200);
    }

    /**
     * Get all billings belong to an sponsor
     *
     * @param integer $sponsorId
     * @param App\Services\BillingService $billingService
     * @return \Illuminate\Http\Response
     */
    public function getBillingsWithSponsorId(Integer $sponsorId, BillingService $billingService)
    {
        $result = new BillingCollection($billingService->getBillingsWithSponsorId($sponsorId));
    }

    /**
     * Get all billings belong to a user
     *
     * @param integer $userId
     * @param App\Services\BillingService $billingService
     * @return \Illuminate\Http\Response
     */
    public function getBillingsWithUserId(Integer $userId, BillingService $billingService)
    {
        $result = new BillingCollection($billingService->getBillingsWithUserId($userId));
    }

    /**
     * Get all designs
     *
     * @param App\Services\DesignService $designService
     * @return \Illuminate\Http\Response
     */
    public function designs(DesignService $designService)
    {
        $result = new DesignCollection($designService->getAllDesigns());

        return response()->json($result, 200);
    }

    /**
     * Create or Update a design
     *
     * @param App\Http\Requests\Order\CreateOrUpdateDesignRequest $request
     * @param App\Services\DesignService $designService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateDesign(CreateOrUpdateDesignRequest $request, DesignService $designService)
    {
        $result = new DesignResource($designService->createOrUpdateDesign($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete a design
     *
     * @param integer $designId
     * @param App\Services\DesignService $designService
     * @return \Illuminate\Http\Response
     */
    public function deleteDesign($designId, DesignService $designService)
    {
        $result = $designService->deleteDesign($designId);

        return response()->json($result, 200);
    }

    /**
     * Upload a design file to AWS S3
     *
     * @param App\Http\Requests\Design\UploadDesignFileRequest $request
     * @param App\Services\ExtraService $extraService
     * @return \Illuminate\Http\Response
     */
    public function uploadDesignFile(UploadDesignFileRequest $request, ExtraService $extraService)
    {
        $result = $extraService->uploadDesignFile($request->all());

        return response()->json(['url' => $result], 200);
    }

    /**
     * Upload an image to AWS S3
     *
     * @param App\Http\Requests\UploadImageRequest $request
     * @param App\Services\ExtraService $extraService
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(UploadImageRequest $request, ExtraService $extraService)
    {
        $result = $extraService->uploadImage($request->all());

        return response()->json(['url' => $result], 200);
    }


    /**
     * Get all charities
     *
     * @param App\Services\CharityService $charityService
     * @return \Illuminate\Http\Response
     */

    public function Assets(AssetService $assetService)
    {
        $result = new AssetCollection($assetService->getAllAssets());

        return response()->json($result, 200);
    }

    /**
     * Create or Update a asset
     *
     * @param App\Http\Requests\Sponsor\CreateOrUpdateCharityRequest $request
     * @param App\Services\AssetService $assetService
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateAsset(CreateOrUpdateAssetRequest $request, AssetService $assetService)
    {
        $result = new AssetResource($assetService->createOrUpdateAsset($request->all()));

        return response()->json($result, 200);
    }

    /**
     * Delete a asset
     *
     * @param integer $assetId
     * @return \Illuminate\Http\Response
     */
    public function deleteAsset($assetId, AssetService $assetService)
    {
        $result = $assetService->deleteAsset($assetId);

        return response()->json($result, 200);
    }

    /**
     * Get asset details
     *
     * @param integer $assetId
     * @param \App\Services\AssetService $assetService
     * @return \Illuminate\Http\Response
     */
    public function assetDetails($assetId, AssetService $assetService)
    {
        $result = new AssetResource($assetService->getAssetById($assetId));

        return response()->json($result, 200);
    }

}
