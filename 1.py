import scrapy
from scrapy_splash import SplashRequest

class pprSpider(scrapy.Spider):
    
    script = """
    function main(splash)
        assert(splash:go(splash.args.url))
        splash:wait(4)
        
        local showmorebtn=splash:select('#gsc_bpf_more')
        showmorebtn:mouse_click()
        splash:wait(4)
        
        return splash:html()
    end
    """
    name = "page1"
    
    
    def start_requests(self):
        url = "https://scholar.google.com/citations?user=ngT8wRgAAAAJ"
        yield SplashRequest(url, self.parse, endpoint='execute', args={'lua_source':self.script})
    
    def parse(self, response):
            for row in response.css("tbody tr"):
                papers ={
                    "title": row.css(".gsc_a_at::text").extract_first(),
                    "no. of citation": row.css(".gsc_a_ac::text").extract_first("0"),
                    "Citation Link": row.css(".gsc_a_ac::attr(href)").extract_first(),
                    "year": row.css(".gsc_a_h.gsc_a_hc.gs_ibl::text").extract_first()
                    }
                yield papers
