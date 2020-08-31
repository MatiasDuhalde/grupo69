import itertools
import random

class Rut:

    RUT_MIN = 25000000
    RUT_MAX = 5000000

    def __init__(self, numeric_value):
        self.__numeric_value = None
        self.numeric_value = numeric_value

    @property
    def numeric_value(self):
        return self.__numeric_value

    @numeric_value.setter
    def numeric_value(self, value):
        self.__numeric_value = value
        self.digito_verificador = Rut.get_digito_verificador(self.__numeric_value)

    @staticmethod
    def get_digito_verificador(number):
        cycle_object = itertools.cycle(range(2,8))
        result = sum([int(digit) * next(cycle_object) for digit in str(number)]) % 11
        if result == 10: return 'K'
        return str(result)

    @classmethod
    def get_random_rut(cls):
        value = random.randrange(100000, 20000000)
        return cls(value)

    def __repr__(self):
        string = f"{self.__numeric_value:,}".replace(",",".")
        return f"{string}-{self.digito_verificador}"


if __name__ == "__main__":
    print(Rut.get_random_rut())
    print(Rut.get_random_rut())
    print(Rut.get_random_rut())
    print(Rut.get_random_rut())
    print(Rut.get_random_rut())
