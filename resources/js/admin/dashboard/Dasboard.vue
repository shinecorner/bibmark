<template>
    <div>
        <div v-if="!isAdmin">
            <h4 class="media align-items-center font-weight-bold py-3 mb-4">
                <img src="/img/avatars/1.png" alt="" class="ui-w-50 rounded-circle">
                <div class="media-body ml-3">
                    Welcome back!
                    <div class="text-muted text-tiny mt-1"><small class="font-weight-normal">Today is Tuesday, 8 February 2018</small></div>
                </div>
            </h4>
        </div>

        <div v-if="isAdmin">
            <!-- Counters -->
            <div class="row">
                <div class="col-sm-6 col-xl-3">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="ion ion-md-contact display-4 text-success"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">Total Sponsors</div>
                                    <div class="text-large">{{totalSponsors.length}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-xl-3">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="lnr lnr-gift display-4 text-info"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">Total Charities</div>
                                    <div class="text-large">{{totalCharities.length}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-xl-3">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="lnr lnr-calendar-full display-4 text-danger"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">Total Events</div>
                                    <div class="text-large">{{totalEvents.length}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-xl-3">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="lnr lnr-users display-4 text-warning"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">Total Users</div>
                                    <div class="text-large">{{totalUsers.length}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- / Counters -->
        </div>
        <div v-else>
            <!-- Counters -->
            <div class="row">
                <div class="col-sm-6 col-xl-3" v-if="userSponsors.length > 0">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="ion ion-md-contact display-4 text-success"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">My Sponsorts</div>
                                    <div v-for="sponsor in userSponsors" v-bind:key="sponsor" class="text-small">
                                        <a :href="'/dashboard/sponsor/'+ sponsor.id +'/home'">{{sponsor.name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-xl-3" v-if="userCharities.length > 0">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="lnr lnr-gift display-4 text-info"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">My Charities</div>
                                    <div v-for="charity in userCharities" v-bind:key="charity" class="text-small">
                                        <a :href="'/dashboard/charity/'+ charity.id +'/home'">{{charity.name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-xl-3" v-if="userEvents.length > 0">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="lnr lnr-calendar-full display-4 text-danger"></div>
                                <div class="ml-3">
                                    <div class="text-muted small">My Events</div>
                                    <div v-for="event in userEvents" v-bind:key="event" class="text-small">
                                        <a :href="'/dashboard/event/'+ event.id +'/home'">{{event.name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- / Counters -->
        </div>

    </div>
</template>

<script src="./Dashboard.js"></script>

<style scoped>

</style>