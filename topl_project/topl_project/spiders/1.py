import scrapy
import time
from scrapy_splash import SplashRequest
from scraper_api import ScraperAPIClient

class pprSpider(scrapy.Spider):
    
    script = """
        function main(splash)
        assert(splash:go(splash.args.url))
        local showmorebtn=splash:select('#gsc_bpf_more')
        showmorebtn:mouse_click()
        splash:wait(4)
        return splash:html()
        end
    """
    name = "page1"
    
    
    def start_requests(self):
        url = "https://scholar.google.com/citations?user=ngT8wRgAAAAJ"
        #url=self.url
        client = ScraperAPIClient('2fc4e63d5f880644a1b7063583fdc796')
        yield SplashRequest(client.scrapyGet(url), self.parse, endpoint='execute', args={'lua_source':self.script})
    
    def parse(self, response):
        userdetail={
            "name":response.css("#gsc_prf_in::text").extract(),
            "imgsrc":response.css("#gsc_prf_pup-img::attr(src)").extract()
            }
        yield userdetail
        for row in response.css("tbody tr"):
            test=row.css("td.gsc_a_t a.gsc_a_at::text").extract_first()
            if test:
                papers ={
                        "title": row.css("td.gsc_a_t a.gsc_a_at::text").extract_first(),
                        "no_of_citation": row.css("td.gsc_a_c a.gsc_a_ac.gs_ibl::text").extract_first("0"),
                        "citation_link": row.css("td.gsc_a_c a.gsc_a_ac.gs_ibl::attr(href)").extract_first("main.html"),
                        "year": row.css("td.gsc_a_y span.gsc_a_h.gsc_a_hc.gs_ibl::text").extract_first("0")
                    }
                yield papers
            else:
                pass

                
class CitSpider(scrapy.Spider):
    
    name = "page2"
    
    
    def start_requests(self):
        #url=self.url
        url = "https://scholar.google.com/scholar?oi=bibs&hl=en&cites=10438299327049367009"
        client = ScraperAPIClient('2fc4e63d5f880644a1b7063583fdc796')
        yield scrapy.Request(client.scrapyGet(url), self.parse)
    
    def parse(self, response):
            for divs in response.css(".gs_ri"):
                yield {
                    "title": divs.css("h3.gs_rt a::text").extract_first("0"),
                    "authors": divs.css(".gs_a a::text").extract(),
                    }
                
                

