import scrapy

class pprSpider(scrapy.Spider):
    name = "papers"
    
    def start_requests(self):
        url = "https://scholar.google.com/citations?user=ngT8wRgAAAAJ"
        yield scrapy.Request(url=url, callback=self.parse)
    
    def parse(self, response):
            for row in response.css("tbody tr"):
                papers= {
                    "title": row.css("a.gsc_a_at::text").extract_first(),
                    "no. of citation": row.css("a.gsc_a_ac.gs_ibl::text").extract_first(),
                    "Citation Link": row.css("a.gsc_a_ac.gs_ibl::attr(href)").extract_first(),
                    "year": row.css("span.gsc_a_h.gsc_a_hc.gs_ibl::text").extract_first()}
                next_page=response.urljoin(papers["Citation Link"])
                yield scrapy.Request(next_page, callback=self.citation_page, meta={"papers": papers})
    def citation_page(self, response):
        papers = response.meta["papers"]
        for divs in response.css("div#gs_res_ccl_mid"):
                    papers["cites"]= {
                        "cit_title": [divs.css("h3.gs_rt a::text").extract_first()]}
        return papers
