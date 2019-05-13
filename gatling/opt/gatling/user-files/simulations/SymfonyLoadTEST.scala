
import scala.concurrent.duration._

import io.gatling.core.Predef._
import io.gatling.http.Predef._
import io.gatling.jdbc.Predef._

class SymfonyLoadTEST extends Simulation {
    // Let's split this big scenario into composable business processes, like one would do with PageObject pattern with Selenium

    // object are native Scala singletons
    object BrowseHome {

      val browse = exec(http("Home")
        .get("/"))
        .pause(2)
        .exec(http("Page 1")
          .get("/?p=1"))
        .pause(670 milliseconds)
        .exec(http("Page 2")
          .get("/?p=2"))
        .pause(629 milliseconds)
        .exec(http("Page 3")
          .get("/?p=3"))
        .pause(734 milliseconds)
        .exec(http("Page 4")
          .get("/?p=4"))
        .pause(5)
    }

    object BrowsePortfolio {

      val browse = exec(http("Portfolio")
        .get("/portfolio"))
        .pause(2)
        .exec(http("Page 1")
          .get("/portfolio?p=1"))
        .pause(670 milliseconds)
        .exec(http("Page 2")
          .get("/portfolio?p=2"))
        .pause(629 milliseconds)
        .exec(http("Page 3")
          .get("/portfolio?p=3"))
        .pause(734 milliseconds)
        .exec(http("Page 4")
          .get("/portfolio?p=4"))
        .pause(5)
    }

    val httpProtocol = http
      .baseUrl("http://nginx:81")
      .acceptHeader("text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8")
      .doNotTrackHeader("1")
      .acceptLanguageHeader("en-US,en;q=0.5")
      .acceptEncodingHeader("gzip, deflate")
      .userAgentHeader("Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:16.0) Gecko/20100101 Firefox/16.0")

    // Now, we can write the scenario as a composition
    val scn = scenario("Scenario Name").exec(BrowseHome.browse,BrowsePortfolio.browse)

    setUp(scn.inject(atOnceUsers(1)).protocols(httpProtocol))

}
