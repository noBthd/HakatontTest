from django.contrib.syndication.views import Feed
from .models import YourModel

class YourFeed(Feed):
    title = "Заголовок вашей RSS-ленты"
    link = "/feed/"  # URL, по которому RSS-лента будет доступна
    description = "Описание вашей RSS-ленты"

    def items(self):
        return YourModel.objects.all()  # Здесь выбираются объекты, которые будут включены в RSS-ленту

    def item_title(self, item):
        return item.title  # Заголовок элемента в ленте

    def item_description(self, item):
        return item.description  # Описание элемента в ленте